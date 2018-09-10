<?php

namespace Laraning\Surveyor\Models;

use Laraning\Surveyor\Models\Profile;
use Laraning\Boost\Traits\CanSaveMany;
use Illuminate\Database\Eloquent\Model;
use Laraning\Boost\Traits\CanCreateMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laraning\Surveyor\Abstracts\SurveyorModel;

class Scope extends SurveyorModel
{
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
