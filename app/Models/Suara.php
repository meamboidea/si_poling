<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Suara extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'calon_id',
        'tps_id',
        'jumlah_suara',
        'saksi_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'calon_id' => 'integer',
        'tps_id' => 'integer',
        'saksi_id' => 'integer',
    ];

    public function calon(): BelongsTo
    {
        return $this->belongsTo(Calon::class);
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
