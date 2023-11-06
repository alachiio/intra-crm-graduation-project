<?php

namespace App\Models\Relations;

use App\Models\Lead;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Team;

trait UserRelations
{
    public function team()
    {
        return $this->hasOne(Team::class, 'leader_id');
    }

    public function currentTeam()
    {
        return $this->belongsTo(Team::class, 'current_team_id');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'assigned_to');
    }
}
