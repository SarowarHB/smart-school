<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('logs')]

#[WithoutTimestamps]

#[Fillable(['type', 'response', 'account_id'])]
class Log extends Model {}
