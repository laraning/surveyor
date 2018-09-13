<?php

namespace Laraning\Surveyor\Models;

use Laraning\Surveyor\Abstracts\SurveyorModel;

class Policy extends SurveyorModel
{
    protected $casts = [
        'is_data_restricted' => 'boolean',
        'can_view_any'       => 'boolean',
    ];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class)->withPivot(
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
