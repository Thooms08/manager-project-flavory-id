<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'manager_id', 'user_id', 'nama', 'email', 'no_tlp', 'tgl_lahir', 
        'domisili', 'alamat', 'pendidikan_terakhir', 'tgl_masuk', 'ktp', 'cv', 'jabatan', 'jenis_karyawan', 'status'
    ];

    // Relasi ke User (Akun Login)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Manager
    public function manager() 
    {
        return $this->belongsTo(Manager::class); // Sesuaikan jika manager menggunakan model User
    }

    public function memberShifts()
    {
        return $this->hasMany(MemberShift::class, 'karyawan_id');
    }
}