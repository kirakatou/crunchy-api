<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'comment'];

    public funtion post(){
    	$this->belongsTo('App\Post');
    }
}
