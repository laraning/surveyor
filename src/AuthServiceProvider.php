<?php

namespace Laraning\Surveyor;

use Laraning\Cheetah\Models\Client;
use Illuminate\Support\Facades\Gate;
use Laraning\Cheetah\Policies\MyClientPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Client::class => MyClientPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
