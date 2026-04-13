<?php

namespace App\Models\Comment;

use App\Models\Account\Account;
use App\Models\Post\Post;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('comments')]

#[WithoutTimestamps]

#[Fillable(['account_id', 'post_id', 'comment', 'last_update'])]
class Comment extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function posts(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function commentsReactions(): HasMany
    {
        return $this->hasMany(Reaction::class, 'comment_id', 'id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class, 'comment_id', 'id');
    }
}
