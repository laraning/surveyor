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

        if (Auth::id() != null && static::$repository == null) {
            $repository             = [];
            $repository['user']     = ['id' => me()->id];
            $respository['client']  = [];
            $repository['scopes']   = [];
            $repository['policies'] = [];
            $repository['policy']   = [];

            $repository['client']['id'] = Client::where('id', Auth::user()->client_id)->first()->id;

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
        static::$repository = $repository;
    }

    public static function retrieve()
    {
        if (is_array(static::$repository)) {
            if (count(static::$repository) > 0) {
                return static::$repository;
            }
        }

        throw RepositoryException::notInitialized();
    }

    public static function isActive()
    {
        return is_array(static::$repository);
    }

    public static function flush()
    {
        static::$repository = null;
    }

    public static function applyPolicies()
    {
        if (SurveyorProvider::isActive()) {
            $repository = static::retrieve();

            foreach ($repository['policies'] as $model => $policy) {
                info("Applying Policy {$policy} to Model {$model}");
                Gate::policy($model, $policy);
            }
        }
    }
}
