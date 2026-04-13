<?php

namespace App\Models;

use App\Models\Assessment\Result;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('groups')]

#[WithoutTimestamps]

#[Fillable(['name', 'is_active', 'color', 'style'])]
class Group extends Model
{
    public function assessmentResults(): HasMany
    {
        return $this->hasMany(Result::class, 'group_id', 'id');
    }
}
