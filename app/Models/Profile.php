<?php

namespace App\Models;

use App\Models\Account\Account;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('profile')]

#[WithoutTimestamps]

#[Fillable(['account_id', 'address', 'city', 'state', 'zip', 'phone', 'picture', 'dob', 'group_id'])]
class Profile extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
