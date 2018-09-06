<?php

namespace Laraning\Surveyor\Models;

use Laraning\Surveyor\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Laraning\Boost\Traits\CanCreateMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileScope extends Model
{
    use SoftDeletes;
    use CanCreateMany;

    protected $guarded = [];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
