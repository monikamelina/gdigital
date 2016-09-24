<?php
namespace App\Mailers;


use App\User;
use Carbon\Carbon;
use App\Notifications\SocialResetPassword as ResetPasswordNotification;

class UserMailer extends Mailer {

    /**
     * [sendWelcomeMessageTo description]
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function sendWelcomeMessageTo(User $user)
    {
    	$view 		= 'email.welcome';
        $subject 	= 'Welcome to GDigital!';
        
        return $this->sendTo($user, $subject, $view);
    }

    /**
     * [sendActivationMessageTo description]
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function sendActivationMessageTo(User $user){
        
        //For reset password email only social auth                         
       $token   = hash_hmac('sha256', str_random(40),config('app.key'));

       \DB::table('password_resets')->insert(['email' => $user->email, 'token' => $token, 'created_at' => new Carbon]);

        $user->notify(new ResetPasswordNotification($token));
    }
}