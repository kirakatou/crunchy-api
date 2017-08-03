<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['user_id', 'following', 'followers'];

    public function profile(){
    	return $this->belongsTo('App\Profile');
    }
}
