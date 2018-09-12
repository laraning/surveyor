<?php

namespace Laraning\Surveyor\Bootstrap;

use Laraning\Cheetah\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laraning\Cheetah\Policies\ClientPolicy;
use Laraning\Surveyor\Exceptions\RepositoryException;

class SurveyorProvider
{
    private static $repository = null;

    public static function init()
    {
        /**
         * Surveyor constructs your user structure into Laravel cache.
         * Reason is it's faster to access since it will run on each request
         * action.
         * Ideally you should cache into a in-memory database like Redis.
         * The Surveyor repository defines:
         * - User information.
         * - Client information.
         * - User profiles.
         * - User profile scopes.
         * - User profile policies.
         * - User policy actions per policy.
         */

        if (Auth::id() != null) {
            $repository             = [];
            $repository['user']     = ['id' => me()->id];
            $respository['client']  = [];
            $repository['scopes']   = [];
            $repository['policies'] = [];
            $repository['policy']   = [];

            $repository['client']['id'] = Client::where('id', Auth::user()->client->id)->first()->id;

            foreach (me()->profiles as $profile) {
                $repository['profiles'][$profile->code] = ['id' => $profile->id,
                                                           'code' => $profile->code,
                                                           'name' => $profile->name];

                foreach ($profile->scopes as $scope) {
                    $repository['scopes'][$scope->model][] = $scope->scope;
                }

                foreach ($profile->policies as $policy) {
                    $repository['policies'][$policy->model] = $policy->policy;

                    $repository['policy'][$policy->policy] = ['viewAny' => $policy->pivot->can_view_any,
                                                              'view' => $policy->pivot->can_view,
                                                              'create' => $policy->pivot->can_create,
                                                              'update' => $policy->pivot->can_update,
                                                              'delete' => $policy->pivot->can_delete,
                                                              'forceDelete' => $policy->pivot->can_force_delete,
                                                              'restore' => $policy->pivot->can_restore];
                }
            };

            static::store($repository);
        }
    }

    private static function store($repository)
    {
        @session_start();
        $_SESSION['surveyor'] = $repository;
    }

    public static function retrieve()
    {
        @session_start();
        if (array_key_exists('surveyor', $_SESSION)) {
            return $_SESSION['surveyor'];
        }

        throw RepositoryException::notInitialized();
    }

    public static function isActive()
    {
        @session_start();
        if (array_key_exists('surveyor', $_SESSION)) {
            return true;
        }

        return false;
    }

    public static function flush()
    {
        @session_start();
        if (array_key_exists('surveyor', $_SESSION)) {
            unset($_SESSION['surveyor']);
        }
    }

    public static function applyPolicies()
    {
        if (SurveyorProvider::isActive()) {
            $repository = static::retrieve();

            foreach ($repository['policies'] as $model => $policy) {
                Gate::policy($model, $policy);
            }
        }
    }
}
