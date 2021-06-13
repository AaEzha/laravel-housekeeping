<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perbaikan extends Model
{
    use HasFactory;
    protected $table = "perbaikan";
    protected $guarded = [];

    /**
     * Get the keluhan that owns the Perbaikan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function keluhan(): BelongsTo
    {
        return $this->belongsTo(Keluhan::class);
    }
}
