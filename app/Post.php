<?php

namespace App;

use Storage;
use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  definition="post",
 *  @SWG\Property(
 *      property="id",
 *      type="integer",
 *      format="int32"
 *  ),
 *  @SWG\Property(
 *      property="user_id",
 *      type="integer",
 *      format="int32"
 *  ),
 *  @SWG\Property(
 *      property="merchant_id",
 *      type="integer",
 *      format="int32"
 *  ),
 *  @SWG\Property(
 *      property="path",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="description",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="taste",
 *      type="number",
 *      format="double"
 *  ),
 *  @SWG\Property(
 *      property="price",
 *      type="number",
 *      format="double"
 *  ),
 *  @SWG\Property(
 *      property="service",
 *      type="number",
 *      format="double"
 *  ),
 *  @SWG\Property(
 *      property="create_at",
 *       type="string"
 *  ),
 *  @SWG\Property(
 *      property="update_at",
 *       type="string"
 *  )
 * )
 */

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

    public function comment(){
    	return $this->hasMany('App\Comment');
    }

    public function like(){
    	return $this->hasMany('App\Comment');
    }

    public function reportlist(){
        return $this->hasMany('App\ReportList');
    }

}
