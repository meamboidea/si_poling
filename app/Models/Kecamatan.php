<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_kecamatan',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function desas(): HasMany
    {
        return $this->hasMany(Desa::class);
    }

    public function tps(): HasMany
    {
        return $this->hasMany(Tps::class);
    }

    public function tims(): HasMany
    {
        return $this->hasMany(Tim::class);
    }

    public function pemilihs(): HasMany
    {
        return $this->hasMany(Pemilih::class);
    }
}
