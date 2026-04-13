<?php

namespace App\Models\Invitation;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('invitation_groups')]

#[WithoutTimestamps]

#[Fillable(['name'])]
class Group extends Model
{
    public function invitationGroupAccounts(): HasMany
    {
        return $this->hasMany(GroupAccount::class, 'invitation_group_id', 'id');
    }
}
