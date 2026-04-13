<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('question_grades')]

#[WithoutTimestamps]

#[Fillable(['name', 'description'])]
class Grade extends Model
{
    protected $primaryKey = 'question_grade_id';
}
