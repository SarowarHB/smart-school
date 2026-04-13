<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('reward_points')]

#[WithoutTimestamps]

#[Fillable(['type', 'value', 'account_id', 'details'])]
class RewardPoint extends Model {}
