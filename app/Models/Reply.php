<?php

namespace App\Models;

use App\Models\Account\Account;
use App\Models\Comment\Comment;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('replies')]

#[WithoutTimestamps]

#[Fillable(['account_id', 'comment_id', 'reply', 'last_update'])]
class Reply extends Model
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
