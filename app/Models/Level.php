<?php

namespace App\Models;

use App\Models\ClassRoom\ClassRoom;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('levels')]

#[WithoutTimestamps]

#[Fillable(['id', 'name'])]
class Level extends Model
{
    public function classes(): HasMany
    {
        return $this->hasMany(ClassRoom::class, 'level_id', 'id');
    }

    public function requestedClasses(): HasMany
    {
        return $this->hasMany(RequestedClass::class, 'id', 'id');
    }

    public function standards(): HasMany
    {
        return $this->hasMany(Standard::class, 'level_id', 'id');
    }
}
