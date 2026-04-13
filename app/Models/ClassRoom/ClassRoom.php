<?php

namespace App\Models\ClassRoom;

use App\Models\Account\School;
use App\Models\Assessment\Log;
use App\Models\Assessment\Schedule;
use App\Models\Assessment\Session;
use App\Models\Censorship\Level;
use App\Models\Invitation\Invitation;
use App\Models\Student\ClassEnrollment;
use App\Models\Student\Submission;
use App\Models\Teacher\ClassAssignment;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('classes')]
#[WithoutTimestamps]
#[Fillable([
    'school_id', 'class_name', 'level_id', 'external_course_id',
    'external_course_metadata', 'external_course_alias_metadata',
    'name', 'tag', 'subject', 'external_user_id', 'google_meet_link',
])]
class ClassRoom extends Model
{
    public function levels(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function schools(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function assessmentLogs(): HasMany
    {
        return $this->hasMany(Log::class, 'class_id');
    }

    public function assessmentSchedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'class_id');
    }

    public function classSessions(): HasMany
    {
        return $this->hasMany(Session::class, 'class_id');
    }

    public function classworks(): HasMany
    {
        return $this->hasMany(Work::class, 'class_id');
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class, 'class_id');
    }

    public function studentClasses(): HasMany
    {
        return $this->hasMany(ClassEnrollment::class, 'class_id');
    }

    public function studentSubmissions(): HasMany
    {
        return $this->hasMany(Submission::class, 'class_id');
    }

    public function teacherClasses(): HasMany
    {
        return $this->hasMany(ClassAssignment::class, 'class_id');
    }
}
