<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tps extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_tps',
        'kecamatan_id',
        'desa_id',
        'alamat',
        'latitude',
        'longitude',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'kecamatan_id' => 'integer',
        'desa_id' => 'integer',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function suaras(): HasMany
    {
        return $this->hasMany(Suara::class);
    }

    public function pemilihs(): HasMany
    {
        return $this->hasMany(Pemilih::class);
    }

    public function saksis(): HasMany
    {
        return $this->hasMany(Saksi::class);
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
