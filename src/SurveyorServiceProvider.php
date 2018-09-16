<?php

namespace Laraning\Surveyor;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Laraning\Boost\Traits\Migratable;
use Laraning\Surveyor\Listeners\BootSurveyor;
use Laraning\Surveyor\Listeners\FlushSurveyor;
use Laraning\Surveyor\Models\Policy;
use Laraning\Surveyor\Models\Profile;
use Laraning\Surveyor\Models\Scope;
use Laraning\Surveyor\Observers\PolicyObserver;
use Laraning\Surveyor\Observers\ProfileObserver;
use Laraning\Surveyor\Observers\ScopeObserver;

class SurveyorServiceProvider extends ServiceProvider
{
    use Migratable;

    protected $migrationPath = __DIR__.'/../database/migrations/';
    protected $migrations = ['surveyor'];

    public function boot()
    {
        $this->publishMigrations('surveyor');

        $this->registerObservers();

        $this->registerListeners();

        $this->registerPublishing();
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/surveyor.php' => config_path('surveyor.php'),
        ], 'surveyor-config');
    }

    protected function registerListeners()
    {
        Event::listen('Illuminate\Auth\Events\Authenticated', function ($authenticated) {
            return (new BootSurveyor($authenticated))->handle();
        });

        Event::listen('Illuminate\Auth\Events\Logout', function ($logout) {
            return (new FlushSurveyor($logout))->handle();
        });

        Event::listen('Illuminate\Auth\Events\Failed', function ($logout) {
            return (new FlushSurveyor($logout))->handle();
        });
    }

    protected function registerObservers()
    {
        Profile::observe(ProfileObserver::class);
        Scope::observe(ScopeObserver::class);
        Policy::observe(PolicyObserver::class);
    }
}
