<?php

namespace App\Models;

use App\Models\Assessment\Question;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('tags')]

#[WithoutTimestamps]

#[Fillable(['question_id', 'tag_name'])]
class Tag extends Model
{
    public function questions(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
