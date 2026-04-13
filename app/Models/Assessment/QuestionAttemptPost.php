<?php

namespace App\Models\Assessment;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

#[Table('assessment_question_attempt_posts')]

#[WithoutTimestamps]

#[Fillable(['account_id', 'reference_id', 'reference_type', 'body', 'assessment_question_id', 'assessment_response_id', 'last_update', 'attempt_id', 'post_id'])]
class QuestionAttemptPost extends Model {}
