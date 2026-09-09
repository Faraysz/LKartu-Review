<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CardController extends Controller
{
    /**
     * Endpoint yang ditulis ke chip NFC / dicetak sebagai QR: /r/{code}
     * Ini satu-satunya URL yang dilihat kartu fisik, permanen selamanya.
     */
    public function redirect(string $code)
    {
        $card = Card::where('unique_code', $code)->first();

        if (!$card) {
            abort(404, 'Kartu tidak ditemukan.');
        }

        if (!$card->isActive() || !$card->target_url) {
            // Kartu belum diaktivasi -> arahkan ke halaman aktivasi
            return redirect()->route('cards.activate.form', ['code' => $code]);
        }

        // Kartu sudah aktif -> langsung lempar ke link Google Review
        return redirect()->away($card->target_url);
    }

    /**
     * Tampilkan form aktivasi untuk kode kartu tertentu.
     */
    public function activateForm(string $code)
    {
        $card = Card::where('unique_code', $code)->firstOrFail();

        if ($card->isActive()) {
            return redirect()->away($card->target_url);
        }

        return view('cards.activate', ['card' => $card]);
    }

    /**
     * Proses aktivasi: simpan target_url, kaitkan ke user, ubah status jadi active.
     * Setelah ini, kartu redirect selamanya tanpa perlu aktivasi ulang.
     */
    public function activate(Request $request, string $code)
    {
        $card = Card::where('unique_code', $code)->firstOrFail();

        if ($card->isActive()) {
            return redirect()->away($card->target_url);
        }

        $validated = $request->validate([
            'business_name' => ['required', 'string', 'max:255'],
            'target_url' => ['required', 'url', 'max:500'],
        ]);

        $card->update([
            'business_name' => $validated['business_name'],
            'target_url' => $validated['target_url'],
            'user_id' => Auth::id(), // null kalau belum pakai auth, boleh diisi nanti
            'status' => 'active',
            'activated_at' => now(),
        ]);

        return redirect()->route('cards.activated', ['code' => $code]);
    }

    /**
     * Halaman konfirmasi pasca-aktivasi.
     * Dipisah dari form supaya pesan sukses tidak ke-bounce oleh logika
     * "kalau sudah aktif, redirect away" di activateForm().
     */
    public function activated(string $code)
    {
        $card = Card::where('unique_code', $code)->firstOrFail();

        if (!$card->isActive()) {
            return redirect()->route('cards.activate.form', ['code' => $code]);
        }

        return view('cards.activated', ['card' => $card]);
    }

    /**
     * [PROTOTYPE] Buat kartu demo baru untuk testing tanpa kartu fisik.
     * Generate unique_code, simpan ke database, redirect ke halaman aktivasi.
     * Nanti dihapus atau dipindah ke admin dashboard setelah auth jadi.
     */
    public function createDemo()
    {
        $card = Card::create([
            'unique_code' => Card::generateUniqueCode(),
            'status' => 'unactivated',
        ]);

        return redirect()->route('cards.activate.form', ['code' => $card->unique_code]);
    }
}
