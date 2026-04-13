<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('personal_access_tokens')]

#[WithoutTimestamps]

#[Fillable(['tokenable_type', 'tokenable_id', 'name', 'token', 'abilities', 'last_used_at', 'expires_at'])]
class PersonalAccessToken extends Model {}
