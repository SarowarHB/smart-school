<?php

namespace App\Models\Question;

use App\Models\Assessment\Question;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('question_cycles')]

#[WithoutTimestamps]

#[Fillable(['name', 'description'])]
class Cycle extends Model
{
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'topic_id', 'id');
    }
}
