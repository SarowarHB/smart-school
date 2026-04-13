<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('actions')]

#[WithoutTimestamps]

#[Fillable(['name'])]
class Action extends Model
{
    public function policies(): HasMany
    {
        return $this->hasMany(Policy::class, 'action_id', 'id');
    }
}
