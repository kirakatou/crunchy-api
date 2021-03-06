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
        'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile() {
        return $this->belongsTo('App\Profile');
    }

    public function admin() {
        return $this->belongsTo('App\Admin');
    }

    public function merchant() {
        return $this->belongsTo('App\Merchant');
    }

    public function post() {
        return $this->hasMany('App\Post');
    }

    public function point() {
        return $this->hasMany('App\Point');
    }
}
