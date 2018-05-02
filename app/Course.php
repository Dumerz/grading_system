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
        return $this->hasMany('App\Courseperiod', 'course', 'id');
    }

    public function getTotalPeriodsAttribute()
    {
        return $this->hasMany('App\Courseperiod', 'course', 'id')->count();
    }

    public function schemes()
    {
        return $this->hasMany('App\Coursescheme', 'course', 'id');
    }

    public function getTotalSchemesAttribute()
    {
        return $this->hasMany('App\Coursescheme', 'course', 'id')->count();
    }

    public function students()
    {
        return $this->hasMany('App\Coursestudent', 'course', 'id');
    }

    public function getTotalStudentsAttribute()
    {
        return $this->hasMany('App\Coursestudent', 'course', 'id')->count();
    }
}
