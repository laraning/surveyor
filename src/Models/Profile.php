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
        return $this->belongsToMany(Policy::class)->withPivot('view_any', 'view', 'create', 'update', 'delete', 'restore', 'force_delete');
    }
}
