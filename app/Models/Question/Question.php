<?php

namespace App\Models\Question;

use App\Models\Account\Type;
use App\Models\Assessment\Resource;
use App\Models\Assessment\Response;
use App\Models\Standard;
use App\Models\Tag;
use App\Models\Teacher\QuestionBank;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('questions')]

#[WithoutTimestamps]

#[Fillable(['type_id', 'description', 'topic_id', 'standard_id', 'question_subject_id', 'question_grade_id', 'status', 'account_id', 'total_approval', 'average_rating', 'reviews', 'rubrics', 'response_rubric', 'open_response_grade', 'open_response', 'title', 'published_state', 'date_added', 'date_updated'])]
class Question extends Model
{
    public function standards(): BelongsTo
    {
        return $this->belongsTo(Standard::class, 'standard_id', 'id');
    }

    public function questionCycles(): BelongsTo
    {
        return $this->belongsTo(Cycle::class, 'topic_id', 'id');
    }

    public function questionTypes(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function questionResources(): HasMany
    {
        return $this->hasMany(Resource::class, 'question_id', 'id');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class, 'question_id', 'id');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class, 'question_id', 'id');
    }

    public function teacherQuestionBanks(): HasMany
    {
        return $this->hasMany(QuestionBank::class, 'question_id', 'id');
    }
}
