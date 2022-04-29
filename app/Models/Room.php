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
        'name',
    ];

    /**
     * The rooms that belong to the user_character.
     */
    public function user_characters(): MorphToMany
    {
        return $this->morphToMany(UserCharacter::class, 'roomable');
    }
}
