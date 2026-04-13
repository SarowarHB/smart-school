<?php

namespace App\Models\Assessment;

use App\Models\Account\Assessment;
use App\Models\Account\Type;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('assessment_questions')]

#[WithoutTimestamps]

#[Fillable(['assessment_id', 'type_id', 'description', 'grade', 'answered', 'ord_id', 'open_response', 'open_response_grade', 'rubrics', 'response_rubric', 'question_id', 'title'])]
class Question extends Model
{
    public function assessments(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }

    public function questionTypes(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function accountAssessments(): HasMany
    {
        return $this->hasMany(Assessment::class, 'assessment_question_id', 'id');
    }

    public function assessmentQuestionAttempts(): HasMany
    {
        return $this->hasMany(QuestionAttempt::class, 'assessment_question_id', 'id');
    }

    public function assessmentResponses(): HasMany
    {
        return $this->hasMany(Response::class, 'assessment_question_id', 'id');
    }
}
