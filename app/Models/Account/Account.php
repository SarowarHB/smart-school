<?php

namespace App\Models\Account;

use App\Models\Assessment\Log;
use App\Models\Assessment\Question;
use App\Models\Assessment\Session;
use App\Models\Comment\Comment;
use App\Models\Comment\Reaction;
use App\Models\Course\WorkReturnMessage;
use App\Models\LinkedAccount;
use App\Models\MarkingPeriod;
use App\Models\Post\Post;
use App\Models\Profile;
use App\Models\Reply;
use App\Models\RequestedClass;
use App\Models\Role;
use App\Models\Student\ClassEnrollment;
use App\Models\Student\Submission;
use App\Models\Student\WorkProductLog;
use App\Models\Teacher\ClassAssignment;
use App\Models\Teacher\QuestionBank;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

#[Table('accounts')]
#[WithoutTimestamps]
#[Fillable([
    'first_name', 'last_name', 'status', 'phone_number',
    'email', 'password', 'account_type_id', 'social_id',
    'external_user_id', 'external_user_profile', 'token', 'api_token',
])]
#[Hidden(['password', 'api_token', 'token'])]
class Account extends Authenticatable
{
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'external_user_profile' => 'array',
            'token' => 'array',
        ];
    }

    public function getRememberToken(): ?string
    {
        return null;
    }

    public function setRememberToken($value): void {}

    public function getRememberTokenName(): string
    {
        return '';
    }

    // ─── Computed attributes ──────────────────────────────────────────────────

    public function getNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function getAvatarAttribute(): ?string
    {
        $profile = $this->external_user_profile;

        return $profile['avatar'] ?? $profile['picture'] ?? null;
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'account_type_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'account_roles', 'account_id', 'role_id')
            ->withPivot('is_active');
    }

    public function accountAssessments(): HasMany
    {
        return $this->hasMany(Assessment::class, 'account_id');
    }

    public function accountSchools(): HasMany
    {
        return $this->hasMany(School::class, 'account_id');
    }

    public function assessmentLogs(): HasMany
    {
        return $this->hasMany(Log::class, 'account_id');
    }

    public function classSessions(): HasMany
    {
        return $this->hasMany(Session::class, 'account_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'account_id');
    }

    public function commentsReactions(): HasMany
    {
        return $this->hasMany(Reaction::class, 'account_id');
    }

    public function courseWorkReturnMessages(): HasMany
    {
        return $this->hasMany(WorkReturnMessage::class, 'account_id');
    }

    public function linkedAccounts(): HasMany
    {
        return $this->hasMany(LinkedAccount::class, 'account_id');
    }

    public function linkedAccounts2(): HasMany
    {
        return $this->hasMany(LinkedAccount::class, 'linked_account_id');
    }

    public function markingPeriods(): HasMany
    {
        return $this->hasMany(MarkingPeriod::class, 'account_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'account_id');
    }

    public function postsReactions(): HasMany
    {
        return $this->hasMany(Reaction::class, 'account_id');
    }

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class, 'account_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class, 'account_id');
    }

    public function requestedClasses(): HasMany
    {
        return $this->hasMany(RequestedClass::class, 'account_id');
    }

    public function studentClasses(): HasMany
    {
        return $this->hasMany(ClassEnrollment::class, 'account_id');
    }

    public function studentSubmissions(): HasMany
    {
        return $this->hasMany(Submission::class, 'account_id');
    }

    public function studentWorkProductLogs(): HasMany
    {
        return $this->hasMany(WorkProductLog::class, 'student_id');
    }

    public function teacherClasses(): HasMany
    {
        return $this->hasMany(ClassAssignment::class, 'account_id');
    }

    public function teacherQuestionBanks(): HasMany
    {
        return $this->hasMany(QuestionBank::class, 'account_id');
    }

    public function teacherQuestions(): HasMany
    {
        return $this->hasMany(Question::class, 'account_id');
    }
}
