<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MemberShift extends Model
{
    protected $fillable = ['uuid', 'karyawan_id', 'kategori_id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function karyawan() {
        return $this->belongsTo(Karyawan::class);
    }

    public function kategori() {
        return $this->belongsTo(KategoriShift::class, 'kategori_id');
    }

    public function jadwals() {
        return $this->hasMany(JadwalShift::class, 'member_id');
    }
}