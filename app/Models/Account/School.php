<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('account_school')]

#[WithoutTimestamps]

#[Fillable(['account_id', 'school_id', 'is_active'])]
class School extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function schools(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
}
