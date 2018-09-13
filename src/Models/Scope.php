<?php

namespace Laraning\Surveyor\Models;

use Laraning\Surveyor\Abstracts\SurveyorModel;

class Scope extends SurveyorModel
{
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
