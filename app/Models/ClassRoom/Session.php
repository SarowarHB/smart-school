<?php

namespace App\Models\ClassRoom;

use App\Models\Account\Account;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('class_session')]

#[WithoutTimestamps]

#[Fillable(['class_id', 'start_time', 'end_time', 'session_status', 'last_update', 'account_id', 'ip', 'computer', 'session_key', 'assessment_id'])]
class Session extends Model
{
    public function classes(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id', 'id');
    }

    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
