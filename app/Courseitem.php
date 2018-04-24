<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courseitem extends Model
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
    protected $table = 'courseitems';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'course', 'period', 'scheme', 'max_score'
    ];
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'item';
    }
    public function _course()
    {
        return $this->belongsTo('App\Course', 'course', 'id');
    }
    public function _period()
    {
        return $this->belongsTo('App\Courseperiod', 'period', 'id');
    }
    public function _scheme()
    {
        return $this->belongsTo('App\Coursescheme', 'scheme', 'id');
    }
}
