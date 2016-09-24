<?php

namespace App\Listeners;

use App\Events\CreateContactList;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuthLoginEventListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(){
      
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle($event)
    {
    	$name = $event->user->name;
        flash("Welcome {$name} you have been logged in", "success");
    }
}
