<?php

namespace Laraning\Surveyor\Observers;

use Laraning\Surveyor\Models\ProfileScope;

class ProfileScopeObserver
{
    public function saving(ProfileScope $model)
    {
        if ($model->scope[0] == '\\') {
            $model->scope = substr($model->scope, 1);
        };

        if ($model->model[0] == '\\') {
            $model->model = substr($model->model, 1);
        };
    }

    public function created(ProfileScope $model)
    {
        //
    }

    public function updated(ProfileScope $model)
    {
        //
    }

    public function deleted(ProfileScope $model)
    {
        //
    }

    public function restored(ProfileScope $model)
    {
        //
    }

    public function forceDeleted(ProfileScope $model)
    {
        //
    }
}
