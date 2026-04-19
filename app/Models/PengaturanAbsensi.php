<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanAbsensi extends Model
{
    protected $fillable = ['manager_id', 'kamera_absen', 'kamera_izin'];
}