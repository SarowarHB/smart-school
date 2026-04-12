<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $table = 'roles';
    public $timestamps = false;

    protected $fillable = ['name'];

    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'account_roles', 'role_id', 'account_id')
                    ->withPivot('is_active');
    }
}
