<?php

namespace App\Models;

use App\Models\Account\Account;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('linked_accounts')]

#[WithoutTimestamps]

#[Fillable(['account_id', 'linked_account_id', 'is_active'])]
class LinkedAccount extends Model
{
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function linkedAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'linked_account_id', 'id');
    }
}
