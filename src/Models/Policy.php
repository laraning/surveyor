<?php

namespace Laraning\Surveyor\Models;

use Laraning\Surveyor\Models\Profile;
use Laraning\Surveyor\Abstracts\SurveyorModel;

class Policy extends SurveyorModel
{
    protected $casts = [
        'is_data_restricted' => 'boolean',
        'can_view_any' => 'boolean',
        'can_view' => 'boolean',
        'can_create' => 'boolean',
        'can_update' => 'boolean',
        'can_delete' => 'boolean',
        'can_restore' => 'boolean',
        'can_force_delete' => 'boolean',
    ];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class)->withPivot(
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
