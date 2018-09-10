<?php

namespace Laraning\Surveyor\Models;

use Laraning\Surveyor\Models\Scope;
use Laraning\Surveyor\Models\Policy;
use Laraning\Surveyor\Abstracts\SurveyorModel;

class Profile extends SurveyorModel
{
    protected $casts = [
        'can_view_any' => 'boolean',
        'can_view' => 'boolean',
        'can_create' => 'boolean',
        'can_update' => 'boolean',
        'can_delete' => 'boolean',
        'can_restore' => 'boolean',
        'can_force_delete' => 'boolean',
    ];


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
            'can_restore',
            'can_force_delete'
        );
    }
}
