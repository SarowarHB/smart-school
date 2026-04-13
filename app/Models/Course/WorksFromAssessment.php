<?php

namespace App\Models\Course;

use App\Models\Account\Assessment;
use App\Models\ClassRoom\Work;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('course_works_from_assessments')]

#[WithoutTimestamps]

#[Fillable(['course_work_id', 'assessment_id'])]
class WorksFromAssessment extends Model
{
    public function classworks(): BelongsTo
    {
        return $this->belongsTo(Work::class, 'course_work_id', 'id');
    }

    public function assessments(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }
}
