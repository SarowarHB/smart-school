<?php

namespace App\Models;

use App\Models\Account\Assessment;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('protocols')]

#[WithoutTimestamps]

#[Fillable(['name'])]
class Protocol extends Model
{
    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class, 'protocol_id', 'id');
    }
}
