<?php

namespace Laraning\Surveyor\Models;

use Laraning\Surveyor\Models\Profile;
use Laraning\Boost\Traits\CanSaveMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilePolicy extends Model
{
    use SoftDeletes;
    use CanSaveMany;

    protected $guarded = [];

    protected $casts = [
        'before' => 'boolean',
        'view_any' => 'boolean',
        'view' => 'boolean',
        'create' => 'boolean',
        'update' => 'boolean',
        'delete' => 'boolean',
        'restore' => 'boolean',
        'force_delete' => 'boolean'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
