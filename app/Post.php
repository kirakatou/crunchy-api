<?php

namespace App;

use Storage;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function merchant() {
        return $this->belongsTo('App\Merchant');
    }

    public function getPathAttribute($value){
    	return Storage::url($value);
    }

}
