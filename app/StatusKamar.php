<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKamar extends Model
{
    use HasFactory;
    protected $table = "status_kamar";
    protected $guarded = [];
}
