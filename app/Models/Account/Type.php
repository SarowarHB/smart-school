<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('account_type')]

#[WithoutTimestamps]

#[Fillable(['name'])]
class Type extends Model
{
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class, 'account_type_id', 'id');
    }
}
