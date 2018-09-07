<?php

namespace Laraning\Surveyor\Models;

use Laraning\Surveyor\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilePolicy extends Model
{
    use SoftDeletes;

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
