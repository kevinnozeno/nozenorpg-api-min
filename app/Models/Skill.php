<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'skills';

    protected $fillable = [
        'slug',
        'name',
        'color',
        'level',
        'type'
    ];

    public function characters(): MorphToMany
    {
        return $this->morphedByMany(Character::class, 'skillable');
    }

    public function user_characters(): MorphToMany
    {
        return $this->morphedByMany(UserCharacter::class, 'skillable');
    }
}
