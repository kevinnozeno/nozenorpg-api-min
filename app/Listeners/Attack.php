<?php

namespace App\Listeners;

use App\Events\NewAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Attack
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
     * @param  NewAction  $event
     * @return void
     */
    public function handle(NewAction $event)
    {
        //
    }
}
