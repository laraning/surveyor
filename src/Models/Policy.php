<?php

namespace Laraning\Surveyor\Models;

use Laraning\Surveyor\Models\Profile;
use Laraning\Surveyor\Abstracts\SurveyorModel;

class Policy extends SurveyorModel
{
    protected $casts = [
        'is_data_restricted' => 'boolean'
    ];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class)->withPivot('view_any', 'view', 'create', 'update', 'delete', 'restore', 'force_delete');
    }
}
