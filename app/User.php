<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','ip', 'active', 'activation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * [social description]
     * @return [type] [description]
     */
    public function social(){
        return $this->hasMany(Social::class);
    }

    /**
     * [profile description]
     * @return [type] [description]
     */
    public function profile(){
        return $this->hasOne(Profile::class);
    }

    /**
     * [contact description]
     * @return [type] [description]
     */
    public function contacts(){
        return $this->hasMany(Contact::class);
    }


    /**
     * [isActive description]
     * @param  [type]  $code [description]
     * @return boolean       [description]
     */
    public function isActive($code) {
    
        if($user = User::where('activation_code', '=', $code)->first()){
            $user->activation_code   = '';
            $user->save();

            return true;
        }

       return false;
    }

    /**
     * [isAdmin description]
     * @return boolean [description]
     */
    public function isAdmin()
    {
        return ($this->admin) ? 'Yes':'No'; 
    }


}
