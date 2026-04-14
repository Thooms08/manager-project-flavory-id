<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalShift extends Model
{
    protected $fillable = [
        'member_id', 'tgl_masuk', 'tgl_libur', 
        'jam_masuk', 'jam_keluar', 'absen_awal', 'absen_akhir'
    ];

    public function member() {
        return $this->belongsTo(MemberShift::class, 'member_id');
    }
    public function absensi() {
        // Satu jadwal terhubung dengan satu record absensi
        return $this->hasOne(AbsensiKaryawan::class, 'jadwal_id');
    }
}