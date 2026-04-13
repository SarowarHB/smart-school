<?php

namespace App\Models\Assessment;

use App\Models\Account\Assessment as AccountAssessment;
use App\Models\Course\WorksFromAssessment;
use App\Models\Protocol;
use App\Models\Standard;
use App\Models\Student\WorkProductLog;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('assessment')]

#[WithoutTimestamps]

#[Fillable(['topic_id', 'level_id', 'title', 'description', 'status', 'group_id', 'protocol_id', 'account_id', 'standard_id', 'submitted', 'last_update', 'rubric', 'class_id', 'grade_value', 'grade_id', 'subject_id', 'is_archived', 'max_point'])]
class Assessment extends Model
{
    public function protocols(): BelongsTo
    {
        return $this->belongsTo(Protocol::class, 'protocol_id', 'id');
    }

    public function standards(): BelongsTo
    {
        return $this->belongsTo(Standard::class, 'standard_id', 'id');
    }

    public function topics(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    public function accountAssessments(): HasMany
    {
        return $this->hasMany(AccountAssessment::class, 'assessment_id', 'id');
    }

    public function assessmentLogs(): HasMany
    {
        return $this->hasMany(Log::class, 'assessment_id', 'id');
    }

    public function assessmentQuestionAttempts(): HasMany
    {
        return $this->hasMany(QuestionAttempt::class, 'assessment_id', 'id');
    }

    public function assessmentQuestions(): HasMany
    {
        return $this->hasMany(Question::class, 'assessment_id', 'id');
    }

    public function assessmentResources(): HasMany
    {
        return $this->hasMany(Resource::class, 'assessment_id', 'id');
    }

    public function assessmentSchedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'assessment_id', 'id');
    }

    public function courseWorksFromAssessments(): HasMany
    {
        return $this->hasMany(WorksFromAssessment::class, 'assessment_id', 'id');
    }

    public function studentWorkProductLogs(): HasMany
    {
        return $this->hasMany(WorkProductLog::class, 'assessment_id', 'id');
    }
}
