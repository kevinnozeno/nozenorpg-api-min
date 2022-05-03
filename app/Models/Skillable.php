<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Skillable extends MorphPivot
{
    use HasFactory;

    protected $table = 'skillables';

    protected $fillable = [
        'skill_id',
        'skillable_id',
        'skillable_type'
    ];
}
