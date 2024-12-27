<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tim extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        'jabatan_id',
        'kecamatan_id',
        'desa_id',
        'jabatantim_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'jabatan_id' => 'integer',
        'kecamatan_id' => 'integer',
        'desa_id' => 'integer',
        'jabatantim_id' => 'integer',
    ];

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

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    public function jabatantim(): BelongsTo
    {
        return $this->belongsTo(Jabatantim::class);
    }

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class);
    }
}
