<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'id',
        'name',
        'level'
    ];

    /**
     * Get all of the user_characters that are assigned this room.
     */
    public function user_characters()
    {
        return $this
            ->morphedByMany(UserCharacter::class, 'roomable')
            ->withPivot('statistics', 'is_active')
            ->using('App\Models\Roomable')
            ->withTimestamps();
    }
}
