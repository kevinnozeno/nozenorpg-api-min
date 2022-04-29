<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Entity extends Model
{
    use HasFactory;

    protected $table = 'entities';

    protected $fillable = [
        'name',
        'controller',
        'model',
    ];

    /**
     * The entities that belong to the action.
     */
    public function actions(): BelongsToMany
    {
        return $this->belongsToMany(Action::class, 'entity_action')->withTimestamps();
    }
}
