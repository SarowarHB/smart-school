<?php

namespace App\Models\Student;

use App\Models\Account\Account;
use App\Models\Account\Assessment;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('student_work_product_logs')]

#[WithoutTimestamps]

#[Fillable(['assessment_id', 'student_id', 'google_drive_response', 'student_submission_response', 'turn_in_response', 'pending_answer', 'stage', 'update_time'])]
class WorkProductLog extends Model
{
    public function assessments(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }

    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'student_id', 'id');
    }
}
