<?php

namespace App\Listeners\Auth;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Services\Auth\FortifyService;
use App\Services\General\LogService;

class DeactivateAccountListener
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
        FortifyService::deactivateAccount($event->user);
        LogService::queue('user', $event->user->name . ' [' . $event->user->email . '] - deactivate');
    }
}
