<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('course_grade_categories')]

#[WithoutTimestamps]

#[Fillable(['id', 'category_type', 'catetory', 'amount', 'course_id', 'external_course_id', 'show_overall_grade'])]
class GradeCategory extends Model {}
