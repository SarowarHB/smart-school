<?php

namespace App\Models\Post;

use App\Models\Account\Account;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('posts_reaction')]

#[WithoutTimestamps]

#[Fillable(['account_id', 'post_id', 'reaction_type', 'last_update'])]
class Reaction extends Model
{
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function posts(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
