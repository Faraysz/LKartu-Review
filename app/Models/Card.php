<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_code',
        'status',
        'user_id',
        'target_url',
        'business_name',
        'activated_at',
    ];

    protected $casts = [
        'activated_at' => 'datetime',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Generate kode unik acak (huruf besar + angka, 8 karakter).
     * Dipakai saat produksi batch kartu baru.
     */
    public static function generateUniqueCode(): string
    {
        do {
            $code = strtoupper(substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(6))), 0, 8));
        } while (self::where('unique_code', $code)->exists());

        return $code;
    }
}
