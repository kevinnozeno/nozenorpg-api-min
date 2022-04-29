<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Action extends Model
{
    use HasFactory;

    protected $table = 'actions';

    protected $fillable = [
        'name',
        'method',
        'description',
        'statistics'
    ];

    /**
     * The actions that belong to the entity.
     */
    public function entities(): BelongsToMany
    {
        return $this->belongsToMany(Entity::class, 'entity_action')->withTimestamps();
    }
}
