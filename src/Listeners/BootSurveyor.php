<?php

namespace Laraning\Surveyor\Listeners;

use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        if (!isset($_SESSION['surveyor'])) {
            @session_start();

            /**
             * Set the authenticated user to the current logged in user.
             * Recreate user profile in session.
             * Current data structure:
             * user[]
             *     id => <user id>
             *     profiles[]
             *         <profile code> => <profile id>
             *             scopes[]
             *                 <model namespace> => <scope namespace>
             */

            $user = [];
            array_set($user, 'id', $this->authenticated->user->id);

            // Get profiles and profile scopes.
            foreach (me()->profiles as $profile) {
                array_set($user, "profiles.{$profile->code}.scopes", $profile->scopes->pluck('scope', 'model')->toArray());
            };

            $_SESSION['surveyor'] = array();
            $_SESSION['surveyor']['user'] = $user;
        };
    }
}
