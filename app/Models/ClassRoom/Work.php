<?php

namespace App\Models\ClassRoom;

use App\Models\Course\WorkReturnMessage;
use App\Models\Course\WorksFromAssessment;
use App\Models\Student\Submission;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('classwork')]

#[WithoutTimestamps]

#[Fillable(['class_id', 'external_course_id', 'metadata', 'title', 'description', 'type', 'grade_category_id', 'point', 'external_course_work_id', 'submission'])]
class Work extends Model
{
    public function classes(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id', 'id');
    }

    public function courseWorkReturnMessages(): HasMany
    {
        return $this->hasMany(WorkReturnMessage::class, 'course_work_id', 'id');
    }

    public function courseWorksFromAssessments(): HasMany
    {
        return $this->hasMany(WorksFromAssessment::class, 'course_work_id', 'id');
    }

    public function studentSubmissions(): HasMany
    {
        return $this->hasMany(Submission::class, 'classwork_id', 'id');
    }
}
