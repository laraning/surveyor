<?php

namespace Laraning\Surveyor\Observers;

use Laraning\Surveyor\Models\Scope;

class ScopeObserver
{
    public function saving(Scope $model)
    {
        if ($model->scope[0] == '\\') {
            $model->scope = substr($model->scope, 1);
        };

        if ($model->model[0] == '\\') {
            $model->model = substr($model->model, 1);
        };
    }

    public function created(Scope $model)
    {
        //
    }

    public function updated(Scope $model)
    {
        //
    }

    public function deleted(Scope $model)
    {
        //
    }

    public function restored(Scope $model)
    {
        //
    }

    public function forceDeleted(Scope $model)
    {
        //
    }
}
