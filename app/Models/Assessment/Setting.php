<?php

namespace App\Models\Assessment;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('assessment_settings')]

#[WithoutTimestamps]

#[Fillable(['assessment_id', 'can_comment'])]
class Setting extends Model {}
