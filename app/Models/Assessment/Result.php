<?php

namespace App\Models\Assessment;

use App\Models\Account\Assessment;
use App\Models\Invitation\Group;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('assessment_result')]

#[WithoutTimestamps]

#[Fillable(['acct_as_id', 'group_id', 'grade', 'last_update'])]
class Result extends Model
{
    public function accountAssessments(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'acct_as_id', 'id');
    }

    public function groups(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
