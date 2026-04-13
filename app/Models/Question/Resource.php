<?php

namespace App\Models\Question;

use App\Models\Assessment\Question;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('question_resources')]

#[WithoutTimestamps]

#[Fillable(['name', 'description', 'res_url', 'question_id', 'type'])]
class Resource extends Model
{
    public function questions(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
