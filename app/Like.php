<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *	definition="like",
 *	@SWG\Property(
 *   	property="id",
 *      type="integer",
 *      format="int32"
 *  ),
 *  @SWG\Property(
 *   	property="user_id",
 *      type="integer",
 *      format="int32"
 *  ),
 *  @SWG\Property(
 *   	property="post_id",
 *      type="integer",
 *      format="int32"
 *  ),
 *  @SWG\Property(
 *   	property="like",
 *      type="boolean"
 *  ),
 *	@SWG\Property(
 *   	property="create_at",
 *       type="string"
 *  ),
 *	@SWG\Property(
 *   	property="update_at",
 *       type="string"
 *  )
 * )
 */

class Like extends Model
{
    protected $fillable = ['user_id', 'post_id', 'like'];

    public function post(){
    	$this->belongsTo('App\Post');
    }
}
