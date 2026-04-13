<?php

namespace App\Models;

use App\Models\Account\Role as AccountRole;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('roles')]

#[WithoutTimestamps]

#[Fillable(['name'])]
class Role extends Model
{
    public function accountRoles(): HasMany
    {
        return $this->hasMany(AccountRole::class, 'role_id', 'id');
    }

    public function policies(): HasMany
    {
        return $this->hasMany(Policy::class, 'role_id', 'id');
    }
}
