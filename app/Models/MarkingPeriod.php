<?php

namespace App\Models;

use App\Models\Account\Account;
use App\Models\Account\School;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('marking_period')]

#[WithoutTimestamps]

#[Fillable(['name', 'start_date', 'end_date', 'active', 'school_id', 'account_id'])]
class MarkingPeriod extends Model
{
    protected $primaryKey = 'period_id';

    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function schools(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
}
