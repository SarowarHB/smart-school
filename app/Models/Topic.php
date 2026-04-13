<?php

namespace App\Models;

use App\Models\Account\Assessment;
use App\Models\Assessment\Question;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('topic')]

#[WithoutTimestamps]

#[Fillable(['name', 'description', 'external_course_id', 'external_metadata'])]
class Topic extends Model
{
    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class, 'topic_id', 'id');
    }

    public function teacherQuestions(): HasMany
    {
        return $this->hasMany(Question::class, 'topic_id', 'id');
    }
}
