<?php

namespace App\Models;

use App\Models\Assessment\Question;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('responses')]

#[WithoutTimestamps]

#[Fillable(['question_id', 'description', 'is_valid', 'rubric', 'sub_grade', 'last_udate', 'title', 'match_label'])]
class Response extends Model
{
    public function questions(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
