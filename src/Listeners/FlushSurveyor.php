<?php

namespace Laraning\Surveyor\Listeners;

use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laraning\Surveyor\Bootstrap\SurveyorProvider;

class FlushSurveyor
{
    public $event;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle()
    {
        SurveyorProvider::flush();
    }
}
