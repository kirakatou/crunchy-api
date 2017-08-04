<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *	definition="user follower",
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
 *   	property="follower_id",
 *      type="integer",
 *      format="int32"
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

class UserFollower extends Model
{
    protected $fillable = ['user_id', 'follower_id'];

    public function profile(){
    	return $this->belongsTo('App\Profile');
    }
}
