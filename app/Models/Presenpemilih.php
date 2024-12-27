<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presenpemilih extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pemilih_id',
        'tps_id',
        'saksi_id',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pemilih_id' => 'integer',
        'tps_id' => 'integer',
        'saksi_id' => 'integer',
    ];

    public function pemilih(): BelongsTo
    {
        return $this->belongsTo(Pemilih::class);
    }

    public function tps(): BelongsTo
    {
        return $this->belongsTo(Tps::class);
    }

    public function saksi(): BelongsTo
    {
        return $this->belongsTo(Saksi::class);
    }
}
