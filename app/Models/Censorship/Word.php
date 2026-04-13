<?php

namespace App\Models\Censorship;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('censored_words')]

#[WithoutTimestamps]

#[Fillable(['description', 'account_id', 'insert_time'])]
class Word extends Model {}
