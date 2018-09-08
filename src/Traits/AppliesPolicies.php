<?php

namespace Laraning\Surveyor\Traits;

use Illuminate\Auth\Access\HandlesAuthorization;
use Laraning\Surveyor\Bootstrap\SurveyorProvider;

trait AppliesPolicies
{
    private $repository;

    use HandlesAuthorization;

    public function __construct()
    {
        $this->repository = SurveyorProvider::retrieve();
    }

    public function viewAny()
    {
        return $this->repository['policy'][get_called_class()][debug_backtrace()[0]['function']];
    }

    public function view()
    {
        return $this->repository['policy'][get_called_class()][debug_backtrace()[0]['function']];
    }

    public function create()
    {
        return $this->repository['policy'][get_called_class()][debug_backtrace()[0]['function']];
    }

    public function update()
    {
        return $this->repository['policy'][get_called_class()][debug_backtrace()[0]['function']];
    }

    public function delete()
    {
        return $this->repository['policy'][get_called_class()][debug_backtrace()[0]['function']];
    }

    public function restore()
    {
        return $this->repository['policy'][get_called_class()][debug_backtrace()[0]['function']];
    }

    public function forceDelete()
    {
        return $this->repository['policy'][get_called_class()][debug_backtrace()[0]['function']];
    }
}
