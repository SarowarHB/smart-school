<?php

namespace App\Models\Teacher;

use App\Models\Account\Account;
use App\Models\Account\Type;
use App\Models\Standard;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('teacher_questions')]

#[WithoutTimestamps]

#[Fillable(['type_id', 'description', 'topic_id', 'standard_id', 'account_id'])]
class Question extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function standards(): BelongsTo
    {
        return $this->belongsTo(Standard::class, 'standard_id', 'id');
    }

    public function topics(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    public function questionTypes(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function teacherQuestionsResponses(): HasMany
    {
        return $this->hasMany(QuestionsResponse::class, 'question_id', 'id');
    }
}
