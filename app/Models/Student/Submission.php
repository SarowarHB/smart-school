<?php

namespace App\Models\Student;

use App\Models\Account\Account;
use App\Models\ClassRoom\ClassRoom;
use App\Models\ClassRoom\Work;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('student_submissions')]

#[WithoutTimestamps]

#[Fillable(['class_id', 'external_course_id', 'account_id', 'submission_metadata', 'classwork_id'])]
class Submission extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function classes(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id', 'id');
    }

    public function classworks(): BelongsTo
    {
        return $this->belongsTo(Work::class, 'classwork_id', 'id');
    }
}
