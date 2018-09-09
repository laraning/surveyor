<?php

namespace Laraning\Surveyor\Abstracts;

use Laraning\Boost\Traits\CanSaveMany;
use Illuminate\Database\Eloquent\Model;
use Laraning\Boost\Traits\CanCreateMany;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class SurveyorModel extends Model
{
    use SoftDeletes;
    use CanCreateMany;
    use CanSaveMany;

    protected $guarded = [];
}
