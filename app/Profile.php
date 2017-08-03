<?php

namespace App;

use App\Title;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $fillable = [
        'user_id', 'name', 'email', 'gender', 'photo',
    ];

    protected $appends = ['max_exp', 'title'];

    public function user() {
        return $this->hasOne('App\User');
    }

    public function follow(){
        return $this->hasMany('App\UserFollower');
    }

    public function getMaxExpAttribute()
    {
        return $this->level * 250;
    }

    public function getTitleAttribute()
    {
    	$title = Title::where('level', '<=', $this->level)->get();
        return $title->last()->name;
    }

}
