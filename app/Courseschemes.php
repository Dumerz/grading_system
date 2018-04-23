<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courseschemes extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'id';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'courseschemes';
}
