<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserCharacter extends Pivot
{
    use HasFactory;

    protected $table = 'user_character';

    protected $with = ['user', 'character'];

    protected $appends = ['roomActive'];

    protected $fillable = [
        'user_id',
        'character_id',
        'level'
    ];

    public function user(): HasOne
    {
        return $this->HasOne(User::class, 'id', 'user_id');
    }

    public function character(): HasOne
    {
        return $this->HasOne(Character::class, 'id', 'character_id');
    }

    public function rooms(): MorphToMany
    {
        return $this
            ->morphToMany(Room::class, 'roomable')
            ->withPivot('statistics', 'is_active')
            ->using('App\Models\Roomable')
            ->withTimestamps();
    }

    public function getRoomActiveAttribute()
    {
        return $this->rooms()->wherePivot('is_active', true)->first();
    }
}
