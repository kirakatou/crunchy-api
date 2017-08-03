<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *	definition="reportlist",
 *	@SWG\Property(
 *   	property="id",
 *      type="integer",
 *      format="int32"
 *  ),
 *	@SWG\Property(
 *   	property="user_id",
 *      type="integer",
 *      format="int32"
 *  )
 *	@SWG\Property(
 *   	property="post_id",
 *      type="integer",
 *      format="int32"
 *  )
 *	@SWG\Property(
 *   	property="report_id",
 *      type="integer",
 *      format="int32"
 *  )
 * )
 */

class ReportList extends Model
{
    protected $fillable = ['user_id', 'post_id', 'report_id'];

    public function post(){
    	$this->belongsTo('App\Post');
    }
}
