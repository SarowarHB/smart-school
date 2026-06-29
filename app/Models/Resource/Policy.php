<?php

namespace App\Models\Resource;

use App\Models\Assessment\Resource;
use App\Models\Policy as AccessPolicy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('resources_policy')]

#[WithoutTimestamps]

#[Fillable(['resource_id', 'policy_id', 'is_active'])]
class Policy extends Model
{
    public function resources(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'resource_id', 'id');
    }

    public function accessPolicy(): BelongsTo
    {
        return $this->belongsTo(AccessPolicy::class, 'policy_id', 'id');
    }
}
