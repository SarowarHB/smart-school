<?php

namespace App\Models\Assessment;

use App\Models\Account\Assessment;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('assessment_resources')]

#[WithoutTimestamps]

#[Fillable(['assessment_id', 'resource_type', 'url', 'question_id', 'resource'])]
class Resource extends Model
{
    public function assessments(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }
}
