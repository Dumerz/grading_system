<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


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
}
