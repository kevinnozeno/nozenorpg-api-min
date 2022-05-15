<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Roomable extends MorphPivot
{
    use HasFactory;

    protected $table = 'roomables';

    protected $casts = [
        'statistics' => AsArrayObject::class
    ];

    protected $fillable = [
        'id',
        'room_id',
        'roomable_id',
        'roomable_type',
        'statistics',
        'is_active'
    ];
}
