<?php

namespace App\Models\Assessment;

use App\Models\Account\Assessment;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('assessment_question_attempt')]

#[WithoutTimestamps]

#[Fillable(['assessment_id', 'assessment_question_id', 'last_update'])]
class QuestionAttempt extends Model
{
    public function assessments(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }

    public function assessmentQuestions(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'assessment_question_id', 'id');
    }

    public function assessmentQuestionResults(): HasMany
    {
        return $this->hasMany(QuestionResult::class, 'attempt_id', 'id');
    }
}
