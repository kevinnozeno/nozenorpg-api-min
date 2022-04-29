<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Roomable extends MorphPivot
{
    use HasFactory;

    protected $table = 'roomables';

    protected $fillable = [
        'user_id',
        'roomable_id',
        'roomable_type'
    ];
}
