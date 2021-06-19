<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    use HasFactory;
    protected $table = "kamar";
    protected $guarded = [];

    /**
     * Get all of the keluhans for the Kamar
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function keluhans(): HasMany
    {
        return $this->hasMany(Keluhan::class);
    }

    /**
     * Get all of the assets for the Kamar
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assets(): HasMany
    {
        return $this->hasMany(AssetKamar::class);
    }
}
