<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SendActivationCode' => [
            'App\Listeners\SendMailListener',
        ],
        'App\Events\CreateContactList' => [
            'App\Listeners\ActiveCampaignListener',
        ],
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\AuthLoginEventListener@handle',
        ],
    ];

    /**
     * [$subscribe description]
     * @var [type]
     */
    protected $subscribe = [
        \App\Listeners\ActiveCampaignEventSubscriber::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
