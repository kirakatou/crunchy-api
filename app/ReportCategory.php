<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *	definition="reportcategory",
 *	@SWG\Property(
 *   	property="id",
 *      type="integer",
 *      format="int32"
 *  ),
 *  @SWG\Property(
 *   	property="name",
 *      type="string"
 *  )
 * )
 */

class ReportCategory extends Model
{
    protected $fillable = [
        'name',
    ];
}
