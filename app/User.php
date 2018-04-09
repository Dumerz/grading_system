<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'name_first', 'name_middle', 'name_last', 'name_suffix', 'gender', 'date_birth', 'email', 'password', 'usertype'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'date_birth'
    ];

    public function getAgeAttribute() {
        return Carbon::parse($this->date_birth)
                                ->diff(Carbon::now())
                                ->format('%y');
    }

    public function getNameFullAttribute() {
        $name = Str::title($this->name_last) . ', ' . Str::title($this->name_first);
        if (!empty($this->name_middle)) {
            $name =$name . ' ' . Str::upper(substr($this->name_middle, 0, 1)) . '.';
        }
        if (!empty($this->name_suffix)) {
            $name =$name . ' ' . ucfirst($this->name_suffix) . '.';
        }
        return $name;
    }
    /**
     * The attributes that connects to verify user table.
     *
     * @return App\VerfiyUser
     */
    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

    public function typeuser()
    {
        return $this->belongsTo('App\Usertype', 'usertype', 'usertype_id');
    }

    public function statususer()
    {
        return $this->belongsTo('App\Userstatus', 'status', 'userstatus_id');
    }
}
