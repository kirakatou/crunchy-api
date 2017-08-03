<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFollower extends Model
{
    protected $fillable = ['user_id', 'follower_id'];

    public function profile(){
    	return $this->belongsTo('App\Profile');
    }
}
