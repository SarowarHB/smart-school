<?php

namespace App\Models\Post;

use App\Models\Account\Account;
use App\Models\Comment\Comment;
use App\Models\Comment\Reaction;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('posts')]

#[WithoutTimestamps]

#[Fillable(['account_id', 'reference_id', 'reference_type', 'body', 'assessment_question_id', 'assessment_response_id', 'last_update', 'attempt_id'])]
class Post extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function postsReactions(): HasMany
    {
        return $this->hasMany(Reaction::class, 'post_id', 'id');
    }
}
