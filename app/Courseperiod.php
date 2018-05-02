<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courseperiod extends Model
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
    protected $table = 'courseperiods';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'course'
    ];
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'period';
    }
    public function course()
    {
        return $this->belongsTo('App\Course', 'course', 'id');
    }
}
