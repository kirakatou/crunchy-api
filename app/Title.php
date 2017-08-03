<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * @SWG\Definition(
 *	definition="title",
 *	@SWG\Property(
 *   	property="id",
 *      type="integer",
 *      format="int32"
 *  ),
 *  @SWG\Property(
 *   	property="level",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *   	property="name",
 *      type="string"
 *  )
 * )
 */


class Title extends Model
{
    protected $fillable = [
        'level', 'name'
    ];
    
    public function user() {
        return $this->belongsTo('App\User');
    }
}
