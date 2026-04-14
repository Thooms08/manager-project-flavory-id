<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerifikasiManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'manager_id',
        'kode_verifikasi',
        'expired_at',
        'is_verified',
    ];

    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
            'is_verified' => 'boolean',
        ];
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }
}