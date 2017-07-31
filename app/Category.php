<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *	definition="category",
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
 *   	property="icon",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *   	property="category",
 *      type="boolean",
 *		default=true
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

class Category extends Model
{
    protected $fillable = ['name', 'icon', 'category'];
}
