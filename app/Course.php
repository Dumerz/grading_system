<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'evaluator', 'status'
    ];

    public function evaluator_user()
    {
        return $this->belongsTo('App\User', 'evaluator', 'id');
    }

    public function _status()
    {
        return $this->belongsTo('App\Coursestatus', 'status', 'coursestatus_id');
    }

    public function periods()
    {
        return $this->hasMany('App\Courseperiods', 'course', 'id');
    }

    public function schemes()
    {
        return $this->hasMany('App\Courseschemes', 'course', 'id');
    }
}
