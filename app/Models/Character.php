<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Character extends Model
{
    use HasFactory;

    protected $table = 'characters';

    protected $with = ['skills'];

    protected $fillable = [
        'name',
        'pv',
        'ad',
        'ap',
        'heal',
        'plays'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_character')
            ->withPivot('level')
            ->withTimestamps();
    }

    public function skills(): MorphToMany
    {
        return $this
            ->morphToMany(Skill::class, 'skillable')
            ->using('App\Models\Skillable')
            ->withTimestamps();
    }
}
