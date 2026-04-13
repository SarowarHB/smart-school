<?php

namespace App\Models\Censorship;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('censorship_levels')]

#[WithoutTimestamps]

#[Fillable(['name'])]
class Level extends Model
{
    public function censorshipWordLists(): HasMany
    {
        return $this->hasMany(WordList::class, 'censorship_id', 'id');
    }
}
