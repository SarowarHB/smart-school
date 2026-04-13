<?php

namespace App\Models\Censorship;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('censorship_word_list')]

#[WithoutTimestamps]

#[Fillable(['name', 'censorship_id', 'replace_with', 'is_active'])]
class WordList extends Model
{
    public function censorshipLevels(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'censorship_id', 'id');
    }
}
