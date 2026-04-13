<?php

namespace App\Models\Assessment;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('assessment_responses')]

#[WithoutTimestamps]

#[Fillable(['assessment_question_id', 'response', 'sub_grade', 'is_correct', 'last_update', 'rubric', 'title', 'match_label'])]
class Response extends Model
{
    public function assessmentQuestions(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'assessment_question_id', 'id');
    }
}
