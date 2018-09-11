<?php

namespace Laraning\Surveyor\Models;

use Laraning\Surveyor\Models\Scope;
use Laraning\Surveyor\Models\Policy;
use Laraning\Surveyor\Abstracts\SurveyorModel;

class Profile extends SurveyorModel
{
    public function users()
    {
        return $this->belongsToMany(config('auth.providers.users.model'))->withTimestamps();
    }

    public function scopes()
    {
        return $this->belongsToMany(Scope::class);
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
        );
    }
}
