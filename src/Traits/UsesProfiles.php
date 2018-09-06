<?php

namespace Laraning\Surveyor\Traits;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Laraning\Surveyor\Models\Profile;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;

trait UsesProfiles
{
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    /**
     * Matches at least one user profile.
     * @param  array  $profiles The user profile string array.
     * @return boolean          True in case it finds at least one.
     */
    public function hasProfile($profiles) : bool
    {
        $profiles = (array) $profiles;
        return count(array_intersect($this->profiles->pluck('code')->toArray(), $profiles)) > 0;
    }

    /**
     * Matches ALL user profiles.
     * @param  array  $profiles The user profile string array.
     * @return boolean          True in case it finds ALL of them.
     */
    public function hasAllProfiles($profiles) : bool
    {
        $profiles = (array) $profiles;
        return count(array_intersect($this->profiles->pluck('code')->toArray(), $profiles)) == count($profiles);
    }

    /**
     * Assigns profiles to the current model.
     * @param  string|array $profiles The profile name(s) from the profiles table.
     * @return void
     */
    public function assignProfiles($profiles) : void
    {
        $profiles = (array) $profiles;
        foreach ($profiles as $profile) {
            $electedProfile = Profile::where('code', $profile)->first();

            // Profile exists and not assigned to user?
            if (!is_null($electedProfile) && !$this->hasProfile($profile)) {
                // Assign both role and permissions defined for this user profile.
                // Into the Spatie Permissions.
                $this->assignRole(Role::find([$electedProfile->role_id])->first()->name);
                $this->givePermissionTo(Permission::find([$electedProfile->permission_id])->first()->name);

                // Assign user profile into the profiles table.
                $this->profiles()->save($electedProfile);
            };
        };
    }

    /**
     * Apply model global scopes given the current logged user profiles.
     * @return void
     */
    public static function applyScopesGivenLoggedProfiles()
    {
        @session_start();

        if (array_key_exists('cheetah', $_SESSION)) {
            $cheetah = $_SESSION['cheetah'];
            $profiles = data_get($cheetah, 'user.profiles');

            // Follow the profiles, and load all global scopes for this model.
            foreach ($profiles as $profile) {
                foreach ($profile['scopes'] as $model => $scope) {
                    info(get_called_class() . ' vs ' .$model);
                    if (get_called_class() == $model) {
                        info('Apply global scope ' . $scope);
                        static::addGlobalScope(new $scope);
                    };
                };
            };
        };

        //static::addGlobalScope(new \Laraning\Surveyor\Scopes\MyUserScope);
    }
}
