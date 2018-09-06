<?php

namespace Laraning\Surveyor\Observers;

use Laraning\Surveyor\Models\ProfileScope;

class ProfileScopeObserver
{
    /**
     * Handle the user "saving" event.
     *
     * @param  \Laraning\Surveyor\Models\Profile
Scope  $model
     * @return void
     */
    public function saving(ProfileScope $model)
    {
        // Remove the \ in case it has it.
        if ($model->scope[0] == '\\') {
            $model->scope = substr($model->scope, 1);
        };

        if ($model->model[0] == '\\') {
            $model->model = substr($model->model, 1);
        };
    }

    /**
     * Handle the user "created" event.
     *
     * @param  \Laraning\Surveyor\Models\Profile
Scope  $model
     * @return void
     */
    public function created(ProfileScope $model)
    {
        //
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \Laraning\Surveyor\Models\Profile
Scope  $model
     * @return void
     */
    public function updated(ProfileScope $model)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \Laraning\Surveyor\Models\Profile
Scope  $model
     * @return void
     */
    public function deleted(ProfileScope $model)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \Laraning\Surveyor\Models\Profile
Scope  $model
     * @return void
     */
    public function restored(ProfileScope $model)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \Laraning\Surveyor\Models\Profile
Scope  $model
     * @return void
     */
    public function forceDeleted(ProfileScope $model)
    {
        //
    }
}
