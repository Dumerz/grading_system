<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Usertype extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'no';

    protected $guarded = [];

    public function user()
    {
        return $this->hasMany('App\User', 'usertype_id', 'usertype');
    }


    public function getTotalRateeAttribute()
    {
        return User::where('usertype', 'USRTYPE001')->count();
    }
}
