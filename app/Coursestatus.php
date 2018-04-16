<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursestatus extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'no';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coursestatus';
}
