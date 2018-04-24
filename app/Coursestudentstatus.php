<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursestudentstatus extends Model
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
    protected $table = 'coursestudentstatus';
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'studentstatus';
    }
}
