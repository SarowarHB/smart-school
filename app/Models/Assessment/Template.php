<?php

namespace App\Models\Assessment;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('assessment_template')]

#[WithoutTimestamps]

#[Fillable(['name', 'account_id', 'rubric', 'status'])]
class Template extends Model {}
