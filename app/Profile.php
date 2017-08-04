<?php

namespace App;

use App\Title;
use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  definition="profile",
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
 *      property="name",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="email",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="gender",
 *      type="boolean"
 *  ),
 *  @SWG\Property(
 *      property="photo",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="max_exp",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="title",
 *      type="string"
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

class Profile extends Model
{
	protected $fillable = [
        'user_id', 'name', 'email', 'gender', 'photo',
    ];

    protected $appends = ['max_exp', 'title'];

    public function user() {
        return $this->hasOne('App\User');
    }

    public function follow(){
        return $this->hasMany('App\UserFollower');
    }

    public function getMaxExpAttribute()
    {
        return $this->level * 250;
    }

    public function getTitleAttribute()
    {
    	$title = Title::where('level', '<=', $this->level)->get();
        return $title->last()->name;
    }

}
