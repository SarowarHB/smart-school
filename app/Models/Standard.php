<?php

namespace App\Models;

use App\Models\Account\Assessment;
use App\Models\Assessment\Question;
use App\Models\Censorship\Level;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('standard')]

#[WithoutTimestamps]

#[Fillable(['name', 'description', 'level_id'])]
class Standard extends Model
{
    public function levels(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id', 'id');
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class, 'standard_id', 'id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'standard_id', 'id');
    }

    public function teacherQuestions(): HasMany
    {
        return $this->hasMany(Question::class, 'standard_id', 'id');
    }
}
