<?php

namespace App\Models\Assessment;

use App\Models\Account\Account;
use App\Models\Account\Assessment;
use App\Models\ClassRoom\ClassRoom;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('assessment_log')]

#[WithoutTimestamps]

#[Fillable(['assessment_id', 'account_id', 'account_id_to', 'class_id', 'message', 'last_update'])]
class Log extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function assessments(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }

    public function classes(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id', 'id');
    }
}
