<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('account_roles')]

#[WithoutTimestamps]

#[Fillable(['account_id', 'role_id', 'is_active'])]
class Role extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function roles(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
