<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('resources')]

#[WithoutTimestamps]

#[Fillable(['name', 'description', 'res_url'])]
class Resource extends Model
{
    public function resourcesPolicies(): HasMany
    {
        return $this->hasMany(Policy::class, 'resource_id', 'id');
    }
}
