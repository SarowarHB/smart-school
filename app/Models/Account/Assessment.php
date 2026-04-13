<?php

namespace App\Models\Account;

use App\Models\Assessment\Question;
use App\Models\Assessment\Result;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('account_assessment')]

#[WithoutTimestamps]

#[Fillable(['assessment_question_id', 'account_id', 'response_id', 'is_correct', 'comments', 'last_update', 'assessment_id', 'attempt_id'])]
class Assessment extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function assessmentQuestions(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'assessment_question_id', 'id');
    }

    public function assessments(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }

    public function assessmentResults(): HasMany
    {
        return $this->hasMany(Result::class, 'acct_as_id', 'id');
    }
}
