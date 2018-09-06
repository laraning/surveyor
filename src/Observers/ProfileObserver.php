<?php

namespace Laraning\Surveyor\Observers;

use Laraning\Surveyor\Models\Profile;

class ProfileObserver
{
    /**
     * Handle the user "saving" event.
     *
     * @param  \Laraning\Surveyor\Models\Profile
  $model
     * @return void
     */
    public function saving(Profile $model)
    {
        // Snake case 'code' attribute, in case it comes empty.
        if (empty($model->code)) {
            $model->code = str_slug($model->name);
        };

        // Remove the \ in case it has it.
        if (starts_with('\\', $model->scope)) {
            dd('ere');
            $model->scope = substr($model->scope, 1);
        };

        if (starts_with('\\', $model->model)) {
            $model->scope = substr($model->model, 1);
        };
    }

    /**
     * Handle the user "created" event.
     *
     * @param  \Laraning\Surveyor\Models\Profile
  $model
     * @return void
     */
    public function created(Profile $model)
    {
        //
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \Laraning\Surveyor\Models\Profile
  $model
     * @return void
     */
    public function updated(Profile $model)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \Laraning\Surveyor\Models\Profile
  $model
     * @return void
     */
    public function deleted(Profile $model)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \Laraning\Surveyor\Models\Profile
  $model
     * @return void
     */
    public function restored(Profile $model)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \Laraning\Surveyor\Models\Profile
  $model
     * @return void
     */
    public function forceDeleted(Profile $model)
    {
        //
    }
}
