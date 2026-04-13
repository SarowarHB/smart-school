<?php

namespace App\Models;

use App\Models\Account\Account;
use App\Models\Censorship\Level;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('requested_classes')]

#[WithoutTimestamps]

#[Fillable(['name', 'section', 'subject', 'room', 'account_id', 'level_id'])]
class RequestedClass extends Model
{
    public function levels(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'id', 'id');
    }

    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
