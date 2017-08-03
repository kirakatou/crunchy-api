<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *	definition="coupon",
 *	@SWG\Property(
 *   	property="id",
 *      type="integer",
 *      format="int32"
 *  ),
 *  @SWG\Property(
 *   	property="coupon_title",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *   	property="point",
 *      type="integer",
 *		format="int32"
 *  ),
 *  @SWG\Property(
 *   	property="description",
 *      type="text"
 *  ),
 *  @SWG\Property(
 *   	property="amount",
 *      type="integer",
 *      format="int32"
 *  )
 * )
 */

class Coupon extends Model
{
    protected $fillable = ['coupon_title', 'point', 'description','amount'];
}
