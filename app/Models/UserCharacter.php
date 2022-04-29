<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserCharacter extends Pivot
{
    use HasFactory;

    protected $table = 'user_character';

    protected $with = ['user', 'character'];

    protected $appends = ['actual_pv'];

    protected $fillable = [
        'user_id',
        'character_id',
        'pv_modif',
        'level'
    ];

    public function rooms(): MorphToMany
    {
        return $this->morphToMany(Room::class, 'roomable');
    }

    public function user(): HasOne
    {
        return $this->HasOne(User::class, 'id', 'user_id');
    }

    public function character(): HasOne
    {
        return $this->HasOne(Character::class, 'id', 'character_id');
    }

    /**
     * Get the user's character's initial pv.
     *
     * @return int
     */
    public function getActualPvAttribute(): int
    {
        return $this->character->pv + $this->pv_modif;
    }
}
