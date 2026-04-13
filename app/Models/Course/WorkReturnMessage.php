<?php

namespace App\Models\Course;

use App\Models\Account\Account;
use App\Models\ClassRoom\Work;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('course_work_return_messages')]

#[WithoutTimestamps]

#[Fillable(['account_id', 'course_work_id', 'message'])]
class WorkReturnMessage extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function classworks(): BelongsTo
    {
        return $this->belongsTo(Work::class, 'course_work_id', 'id');
    }
}
