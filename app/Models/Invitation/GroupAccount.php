<?php

namespace App\Models\Invitation;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('invitation_group_accounts')]

#[WithoutTimestamps]

#[Fillable(['account_id', 'invitation_group_id'])]
class GroupAccount extends Model
{
    public function invitationGroups(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'invitation_group_id', 'id');
    }
}
