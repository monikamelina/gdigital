<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'phone','email',
    ];

    protected $hidden = ['user_id'];

	/**
	 * [user description]
	 * @return [type] [description]
	 */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * [fields description]
     * @return [type] [description]
     */
    public function fields(){
        return $this->hasMany('App\Field', 'contact_id');
    }
}
