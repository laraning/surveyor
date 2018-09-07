<?php

namespace Laraning\Surveyor\Models;

use Laraning\Surveyor\Models\Profile;
use Laraning\Boost\Traits\CanSaveMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileScope extends Model
{
    use SoftDeletes;
    use CanSaveMany;

    protected $guarded = [];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
