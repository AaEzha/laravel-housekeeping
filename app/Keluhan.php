<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Keluhan extends Model
{
    use HasFactory;
    protected $table = "keluhan";
    protected $guarded = [];

    /**
     * Get the kamar that owns the Keluhan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id', 'id');
    }

    /**
     * Get all of the perbaikans for the Keluhan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perbaikans(): HasMany
    {
        return $this->hasMany(Perbaikan::class);
    }
}
