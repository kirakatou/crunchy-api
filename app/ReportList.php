<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportList extends Model
{
    protected $fillable = ['user_id', 'post_id', 'report_id'];

    public function post(){
    	$this->belongsTo('App\Post');
    }
}
