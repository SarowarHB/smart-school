<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('coursework_assessment_responses')]

#[WithoutTimestamps]

#[Fillable(['course_work_id', 'response', 'sub_grade', 'is_correct', 'last_update', 'meta_data', 'external_id', 'user_id', 'returned_to_student', 'turned_in'])]
class WorkAssessmentResponse extends Model {}
