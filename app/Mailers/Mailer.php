<?php
namespace App\Mailers;

use Illuminate\Mail\Mailer as Mail;

abstract class Mailer {

    /**
     * [$mail description]
     * @var [type]
     */
    private $mail;

    /**
     * [__construct description]
     * @param Mail $mail [description]
     */
    function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * [sendTo description]
     * @param  [type] $user    [description]
     * @param  [type] $subject [description]
     * @param  [type] $view    [description]
     * @param  array  $data    [description]
     * @return [type]          [description]
     */
    public function sendTo($user, $subject, $view, $data = [])
    {
        $this->mail->queue($view, $data, function($message) use($user, $subject)
        {
            $message->to($user->email);
            $message->subject($subject);
            
            $message->from(config('mail.from.address'), config('mail.from.name'));
        });
    }
} 