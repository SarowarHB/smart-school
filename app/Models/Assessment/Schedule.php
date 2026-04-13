<?php

namespace App\Models\Assessment;

use App\Models\Account\Assessment;
use App\Models\ClassRoom\ClassRoom;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('assessment_schedule')]

#[WithoutTimestamps]

#[Fillable(['class_id', 'assessment_id', 'start_time', 'end_time', 'status', 'account_id', 'period_id'])]
class Schedule extends Model
{
    public function assessments(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }

    public function classes(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id', 'id');
    }
}
