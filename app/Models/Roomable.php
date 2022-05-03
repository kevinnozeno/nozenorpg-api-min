<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Roomable extends MorphPivot
{
    use HasFactory;

    protected $table = 'roomables';

    protected $casts = [
        'statistics' => AsArrayObject::class
    ];

//    protected $appends = ['actual_pv'];

    protected $fillable = [
        'room_id',
        'roomable_id',
        'roomable_type',
        'statistics',
        'is_active'
    ];

//    /**
//     * Get the user's character's initial pv.
//     *
//     * @return int
//     */
//    public function getActualPvAttribute(): int
//    {
//        return $this->character->pv + $this->pv_modif;
//    }
}
