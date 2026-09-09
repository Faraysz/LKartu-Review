<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();

            // Kode unik yang ditulis ke chip NFC / dicetak sebagai QR.
            // Ini yang PERMANEN, tidak pernah berubah seumur hidup kartu.
            $table->string('unique_code', 12)->unique();

            // Status kartu: unactivated -> active
            $table->enum('status', ['unactivated', 'active'])->default('unactivated');

            // Pemilik kartu (diisi saat aktivasi)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Tujuan redirect (link Google Review Business), diisi saat aktivasi
            $table->string('target_url')->nullable();

            // Opsional: nama usaha, biar gampang dikenali di dashboard
            $table->string('business_name')->nullable();

            $table->timestamp('activated_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
