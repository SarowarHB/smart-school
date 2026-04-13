<?php

namespace App\Models\Grade;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('grade_setting')]

#[WithoutTimestamps]

#[Fillable(['courseid', 'calculation_type', 'show_grade', 'exclude_missing'])]
class Setting extends Model
{
    protected $primaryKey = 'setting_id';

    public function gradeCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'setting_id', 'setting_id');
    }
}
