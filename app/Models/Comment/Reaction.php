<?php

namespace App\Models\Comment;

use App\Models\Account\Account;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('comments_reaction')]

#[WithoutTimestamps]

#[Fillable(['account_id', 'comment_id', 'reaction_type', 'last_update'])]
class Reaction extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function comments(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }
}
