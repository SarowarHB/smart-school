<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('question_subjects')]

#[WithoutTimestamps]

#[Fillable(['name', 'description'])]
class Subject extends Model
{
    protected $primaryKey = 'question_subject_id';
}
