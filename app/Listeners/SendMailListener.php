<?php

namespace App\Listeners;

use App\Events\SendActivationCode;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Mailers\UserMailer;

class SendMailListener
{
    /**
     * [$mailer description]
     * @var [type]
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  SendActivationCode  $event
     * @return void
     */
    public function handle(SendActivationCode $event)
    {
        $this->mailer->sendActivationMessageTo($event->user);
    }
}