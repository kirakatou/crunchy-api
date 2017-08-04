<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *	definition="merchant",
 *	@SWG\Property(
 *   	property="id",
 *      type="integer",
 *      format="int32"
 *  ),
 *  @SWG\Property(
 *   	property="name",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *   	property="address",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *   	property="phone_no",
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

class Merchant extends Model
{
    public function post() {
        return $this->hasMany('App\Post');
    }

    public function user() {
        return $this->hasOne('App\User');
    }
}
