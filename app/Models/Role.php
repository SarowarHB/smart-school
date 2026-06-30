<?php

namespace App\Models;

use App\Models\Account\Account;
use App\Models\Resource\Resource;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Table('roles')]

#[WithoutTimestamps]

#[Fillable(['name'])]
class Role extends Model
{
    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'account_roles', 'role_id', 'account_id')
            ->withPivot('is_active');
    }

    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(Resource::class, 'role_resources', 'role_id', 'resource_id');
    }
}
