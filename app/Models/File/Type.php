<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('file_types')]

#[WithoutTimestamps]

#[Fillable(['extension', 'kind_of_file', 'file_type', 'fclass'])]
class Type extends Model {}
