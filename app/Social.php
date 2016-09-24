<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
	/**
	 * [user description]
	 * @return [type] [description]
	 */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
