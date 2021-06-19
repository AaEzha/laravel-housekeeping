<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetKamar extends Model
{
    use HasFactory;
    protected $table = "asset_kamar";
    protected $guarded = [];

    /**
     * Get the kamar that owns the AssetKamar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class);
    }
}
