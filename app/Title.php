<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $fillable = [
        'level', 'name'
    ];
    
    public function user() {
        return $this->belongsTo('App\User');
    }
}
