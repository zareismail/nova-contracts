<?php

namespace Zareismail\NovaContracts\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Zareismail\NovaContracts\Nova\General;

class RegisteredUser
{ 
    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    { 
        if($roleId = intval(General::option('guest_role'))) {
            $event->user->roles()->attach($roleId);
        }
    }
}
