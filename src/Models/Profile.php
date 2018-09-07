<?php

namespace Laraning\Surveyor\Models;

use Spatie\Permission\Models\Role;
use Laraning\Boost\Traits\CanSaveMany;
use Illuminate\Database\Eloquent\Model;
use Laraning\Boost\Traits\CanCreateMany;
use Spatie\Permission\Models\Permission;
use Laraning\Surveyor\Models\ProfileScope;
use Laraning\Surveyor\Models\ProfilePolicy;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;
    use CanCreateMany;
    use CanSaveMany;

    protected $guarded = [];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function users()
    {
        return $this->belongsToMany(config('auth.providers.users.model'))->withTimestamps();
    }

    public function scopes()
    {
        return $this->hasMany(ProfileScope::class);
    }

    public function policies()
    {
        return $this->hasMany(ProfilePolicy::class);
    }
}
