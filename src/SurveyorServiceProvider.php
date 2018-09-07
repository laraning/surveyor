<?php

namespace Laraning\Surveyor;

use Illuminate\Support\Facades\Gate;
use Laraning\Boost\Traits\Migratable;
use Laraning\Surveyor\Models\Profile;
use Illuminate\Support\ServiceProvider;
use Laraning\Surveyor\Models\ProfileScope;
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
