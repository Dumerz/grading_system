<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Usertype extends Model
{

	protected $primaryKey = 'usertype_id';

    protected $guarded = [];

    public function user()
    {
        return $this->hasMany('App\User', 'usertype_id', 'usertype');
    }
}
