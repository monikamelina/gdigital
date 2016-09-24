<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    
    /**
     * [$fillable description]
     * @var [type]
     */
    
    protected $fillable =[ 'state' , 'city' , 'country', 'website' , 'ocupation'];
    /**
     * [user description]
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getFullAddressAttribute(){
    	return ucfirst($this->city).', '.ucfirst($this->state).' '.($this->country);
    }
}
