<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('announcements')]

#[WithoutTimestamps]

#[Fillable(['class_id', 'account_id', 'announcement_metadata'])]
class Announcement extends Model {}
