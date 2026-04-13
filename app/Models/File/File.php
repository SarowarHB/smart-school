<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('files')]

#[WithoutTimestamps]

#[Fillable(['name', 'type', 'url'])]
class File extends Model {}
