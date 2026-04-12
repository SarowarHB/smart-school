<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Account extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'accounts';

    // accounts has no created_at / updated_at columns
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'status',
        'phone_number',
        'account_type_id',
        'social_id',
        'external_user_id',
        'external_user_profile',
        'token',
        'api_token',
    ];

    protected $hidden = ['password', 'api_token', 'token'];

    protected $casts = [
        'status'                 => 'boolean',
        'external_user_profile'  => 'array',
        'token'                  => 'array',
    ];

    // ─── No remember_token column — disable the trait's default behaviour ─────
    public function getRememberToken(): ?string
    {
        return null;
    }

    public function setRememberToken($value): void
    {
        // no-op: accounts table has no remember_token column
    }

    public function getRememberTokenName(): string
    {
        return '';
    }

    // ─── Computed attributes ──────────────────────────────────────────────────

    /**
     * Full name from first_name + last_name (used by the UI).
     */
    public function getNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    /**
     * Avatar URL stored inside external_user_profile JSON.
     */
    public function getAvatarAttribute(): ?string
    {
        $profile = $this->external_user_profile;
        return $profile['avatar'] ?? $profile['picture'] ?? null;
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class, 'account_type_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'account_roles', 'account_id', 'role_id')
                    ->withPivot('is_active');
    }
}
