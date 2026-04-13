<?php

namespace App\Models\Teacher;

use App\Models\Account\Account;
use App\Models\ClassRoom\ClassRoom;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('teacher_class')]

#[WithoutTimestamps]

#[Fillable(['class_id', 'account_id', 'status', 'external_teacher_metadata', 'invitation_metadata'])]
class ClassAssignment extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function classes(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id', 'id');
    }
}
