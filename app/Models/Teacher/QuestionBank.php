<?php

namespace App\Models\Teacher;

use App\Models\Account\Account;
use App\Models\Assessment\Question;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('teacher_question_bank')]

#[WithoutTimestamps]

#[Fillable(['account_id', 'question_id'])]
class QuestionBank extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function questions(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
