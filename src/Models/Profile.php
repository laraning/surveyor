<?php

namespace Laraning\Surveyor\Models;

use Laraning\Cheetah\Models\User;
use Laraning\Surveyor\Models\Scope;
use Laraning\Surveyor\Models\Policy;
use Laraning\Surveyor\Abstracts\SurveyorModel;

class Profile extends SurveyorModel
{
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function scopes()
    {
        return $this->belongsToMany(Scope::class)->withTimestamps();
    }

    public function policies()
    {
        return $this->belongsToMany(Policy::class)->withPivot(
            'can_view_any',
            'can_view',
            'can_create',
            'can_update',
            'can_delete',
            'can_force_delete',
            'can_restore'
        )->withTimestamps();
    }
}
