<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursestudent extends Model
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
    protected $table = 'coursestudents';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course', 'student', 'status'
    ];

    public function _user()
    {
        return $this->belongsTo('App\User', 'student', 'id');
    }

    public function _course()
    {
        return $this->belongsTo('App\Course', 'course', 'id');
    }

    public function _status()
    {
        return $this->belongsTo('App\Coursestudentstatus', 'status', 'coursestudentstatus_id');
    }
}
