<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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
    public function user_characters(): MorphToMany
    {
        return $this
            ->morphedByMany(UserCharacter::class, 'roomable')
            ->withPivot('statistics', 'is_active', 'id')
            ->orderBy('statistics->order')
            ->using('App\Models\Roomable')
            ->withTimestamps();
    }
}
