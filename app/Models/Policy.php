<?php

namespace App\Models;

use App\Models\Account\Role;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('policy')]

#[WithoutTimestamps]

#[Fillable(['role_id', 'action_id', 'name', 'description'])]
class Policy extends Model
{
    public function actions(): BelongsTo
    {
        return $this->belongsTo(Action::class, 'action_id', 'id');
    }

    public function roles(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
