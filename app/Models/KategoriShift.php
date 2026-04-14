<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriShift extends Model
{
    protected $fillable = ['uuid', 'manager_id', 'shift'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function manager() {
        return $this->belongsTo(Manager::class);
    }

    public function members() {
        return $this->hasMany(MemberShift::class, 'kategori_id');
    }
}