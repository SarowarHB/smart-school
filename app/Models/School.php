<?php

namespace App\Models;

use App\Models\Account\School as AccountSchool;
use App\Models\ClassRoom\ClassRoom;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('schools')]

#[WithoutTimestamps]

#[Fillable(['school_name', 'address', 'city', 'state', 'zip', 'district', 'phone', 'contact_name', 'domain'])]
class School extends Model
{
    public function accountSchools(): HasMany
    {
        return $this->hasMany(AccountSchool::class, 'school_id', 'id');
    }

    public function classes(): HasMany
    {
        return $this->hasMany(ClassRoom::class, 'school_id', 'id');
    }

    public function markingPeriods(): HasMany
    {
        return $this->hasMany(MarkingPeriod::class, 'school_id', 'id');
    }
}
