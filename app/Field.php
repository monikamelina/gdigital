<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
	/**
	 * [contact description]
	 * @return [type] [description]
	 */
    public function contact(){
    	
    	return $this->belongsTo('App\Contact', 'contact_id');
    }
}
