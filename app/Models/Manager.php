<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Manager extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'uuid',
        'manager_key',
        'nama',
        'email',
        'no_whatsapp',
        'jenis_bisnis',
        'status',
        'invoice_number',  
        'payment_url',      
        'payment_status',
    ];

    /**
     * Relasi ke User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function verifikasi()
    {
        return $this->hasOne(VerifikasiManager::class);
    }
}