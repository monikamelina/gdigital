<?php namespace App\Repositories;

use App\User;
use App\Social;
use App\Profile;
use App\CaptureIp;

class UserRepository {

    /**
     * [findOrCreateUser description]
     * @param  [type] $user     [description]
     * @param  [type] $provider [description]
     * @return [type]           [description]
     */
    public function findOrCreateUser($user, $provider)
    {
        if ($u = User::where('email', $user->email)->first()){
            return $u;              // User found return user
        }
        
        $social = Social::where([
            ['social_id', '=', $user->id],
            ['provider', '=', $provider]])->first();

        if($social)
            return $social->user;   // Social User found return user

        $new_user                                   = new User;
        $new_user->email                            = $user->email;
        $new_user->name                             = $user->name;

        // User Active List   
        $new_user->active                           = 0;

        $new_user->password                         = bcrypt(substr($user->token, 0, 10)); //Dummy password
        $new_user->ip                               = CaptureIp::getClientIp();
        $new_user->save();
        
        $social                                     = new Social;
        $social->social_id                          = $user->id;
        $social->provider                           = $provider;
        $new_user->social()->save($social);

        $profile                                    = new Profile;
        $profile->avatar                            = $user->avatar;
        $profile->nickname                          = $user->nickname;
        $new_user->profile()->save($profile);

        return $new_user;
         
    }
} 