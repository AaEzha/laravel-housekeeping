<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class);
    }
}
