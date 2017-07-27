<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'post_id', 'like'];

    public function post(){
    	$this->belongsTo('App\Post');
    }
}