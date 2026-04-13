<?php

namespace App\Models\Student;

use App\Models\Account\Account;
use App\Models\ClassRoom\ClassRoom;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('student_class')]

#[WithoutTimestamps]

#[Fillable(['class_id', 'account_id', 'status', 'enrollment_code', 'external_student_metadata', 'invitation_metadata'])]
class ClassEnrollment extends Model
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
