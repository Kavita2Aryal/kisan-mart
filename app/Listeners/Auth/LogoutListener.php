<?php

namespace App\Listeners\Auth;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Services\Auth\FortifyService;
use App\Services\General\LogService;

class LogoutListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        FortifyService::deleteSession($event->user);
        LogService::queue('user', $event->user->name . ' [' . $event->user->email . '] - logout');
    }
}
