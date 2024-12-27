<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Desa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_desa',
        'kecamatan_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'kecamatan_id' => 'integer',
    ];

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

    public function saksis(): HasMany
    {
        return $this->hasMany(Saksi::class);
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
