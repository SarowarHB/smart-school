<?php

namespace App\Models\Assessment;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('assessment_status')]

#[WithoutTimestamps]

#[Fillable(['assessment_id', 'start_time', 'end_time', 'last_update', 'status'])]
class Status extends Model {}
