<?php

namespace Laraning\Surveyor\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laraning\Boost\Traits\CanCreateMany;
use Laraning\Boost\Traits\CanSaveMany;

abstract class SurveyorModel extends Model
{
    use SoftDeletes;
    use CanCreateMany;
    use CanSaveMany;

    protected $guarded = [];
}
