<?php

namespace App\Models\Question;

use App\Models\Assessment\Question;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('question_type')]

#[WithoutTimestamps]

#[Fillable(['id', 'name', 'description'])]
class Type extends Model
{
    public function assessmentQuestions(): HasMany
    {
        return $this->hasMany(Question::class, 'type_id', 'id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'type_id', 'id');
    }

    public function teacherQuestions(): HasMany
    {
        return $this->hasMany(Question::class, 'type_id', 'id');
    }
}
