<?php

namespace Laraning\Surveyor\Observers;

use Laraning\Surveyor\Models\Profile;

class ProfilePolicyObserver
{
    public function saving(Profile $model)
    {
        if ($model->policy[0] == '\\') {
            $model->policy = substr($model->policy, 1);
        };

        if ($model->model[0] == '\\') {
            $model->model = substr($model->model, 1);
        };
    }

    public function created(Profile $model)
    {
        //
    }

    public function updated(Profile $model)
    {
        //
    }

    public function deleted(Profile $model)
    {
        //
    }

    public function restored(Profile $model)
    {
        //
    }

    public function forceDeleted(Profile $model)
    {
        //
    }
}
