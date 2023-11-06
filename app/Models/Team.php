<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends BaseModel
{
    use SoftDeletes;

    const URL = 'teams';

    public static string $breadcurmbs = 'leader.name';

    protected $appends = [
        'created',
    ];

    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'current_team_id');
    }
}
