<?php

namespace Laraning\Surveyor\Listeners;

use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laraning\Surveyor\Bootstrap\SurveyorProvider;

class BootSurveyor
{
    public $authenticated;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($authenticated)
    {
        $this->authenticated = $authenticated;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle()
    {
        // Bootstrap Surveyor.
        SurveyorProvider::init();
    }
}
