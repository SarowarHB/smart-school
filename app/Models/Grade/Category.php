<?php

namespace App\Models\Grade;

use App\Models\Assessment\Setting;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('grade_category')]

#[WithoutTimestamps]

#[Fillable(['setting_id', 'category_name', 'category_point'])]
class Category extends Model
{
    protected $primaryKey = 'category_id';

    public function gradeSettings(): BelongsTo
    {
        return $this->belongsTo(Setting::class, 'setting_id', 'setting_id');
    }
}
