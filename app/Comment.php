<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *	definition="comment",
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
 *   	property="comment",
 *      type="string"
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

class Comment extends Model
{
    protected $fillable = ['user_id', 'post_id', 'comment'];

    public function post(){
    	$this->belongsTo('App\Post');
    }
}
