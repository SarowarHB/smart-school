<?php

namespace App\Models\Assessment;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('assessment_question_results')]

#[WithoutTimestamps]

#[Fillable(['attempt_id', 'response', 'response_id', 'responders', 'account_id'])]
class QuestionResult extends Model
{
    public function assessmentQuestionAttempts(): BelongsTo
    {
        return $this->belongsTo(QuestionAttempt::class, 'attempt_id', 'id');
    }
}
