<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetKamar extends Model
{
    use HasFactory;
    protected $table = "asset_kamar";
    protected $guarded = [];
}
