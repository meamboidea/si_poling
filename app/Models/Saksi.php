<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Saksi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_saksi',
        'no_hp',
        'email',
        'foto',
        'status',
        'kecamatan_id',
        'desa_id',
        'tps_id',
        'tim_id',
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
        'tps_id' => 'integer',
        'tim_id' => 'integer',
    ];

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    public function tps(): BelongsTo
    {
        return $this->belongsTo(Tps::class);
    }

    public function tim(): BelongsTo
    {
        return $this->belongsTo(Tim::class);
    }

    public function suaras(): HasMany
    {
        return $this->hasMany(Suara::class);
    }

    public function presenpemilihs(): HasMany
    {
        return $this->hasMany(Presenpemilih::class);
    }


}
