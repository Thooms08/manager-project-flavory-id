<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiKaryawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'manager_id', 'karyawan_id', 'jadwal_id', 'status', 'keterangan', 'foto'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalShift::class, 'jadwal_id');
    }
}