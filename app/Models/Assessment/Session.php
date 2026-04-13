<?php

namespace App\Models\Assessment;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('assessment_session')]

#[WithoutTimestamps]

#[Fillable(['assessment_id', 'account_id', 'logintime'])]
class Session extends Model {}
