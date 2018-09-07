<?php

namespace Laraning\Surveyor;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Event;
use Laraning\Boost\Traits\Migratable;
use Laraning\Surveyor\Models\Profile;
use Illuminate\Support\ServiceProvider;
use Laraning\Surveyor\Models\ProfileScope;
use Laraning\Surveyor\Listeners\BootSurveyor;
use Laraning\Surveyor\Listeners\FlushSurveyor;
use Laraning\Surveyor\Observers\ProfileObserver;
use Laraning\Surveyor\Commands\MakeNovaLinkCommand;
use Laraning\Surveyor\Observers\ProfileScopeObserver;

class SurveyorServiceProvider extends ServiceProvider
{
    use Migratable;

    protected $migrationPath = __DIR__ . '/../database/migrations/';
    protected $migrations = ['surveyor'];

    public function boot()
    {
        $this->publishMigrations('surveyor');
        $this->registerObservers();
        $this->registerListeners();
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
        ProfileScope::observe(ProfileScopeObserver::class);
    }

    public function register()
    {
        $this->commands([
            MakeNovaLinkCommand::class]);
    }
}
