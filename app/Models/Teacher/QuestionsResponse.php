<?php

namespace App\Models\Teacher;

use App\Models\Assessment\Question;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('teacher_questions_responses')]

#[WithoutTimestamps]

#[Fillable(['question_id', 'description', 'is_valid'])]
class QuestionsResponse extends Model
{
    public function teacherQuestions(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
