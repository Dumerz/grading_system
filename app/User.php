<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
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

    public function getAgeAttribute() {
        return Carbon::parse($this->date_birth)
                                ->diff(Carbon::now())
                                ->format('%y');
    }

    public function getNameFullAttribute() {
        return ucfirst($this->name_last) . ', ' . ucfirst($this->name_first) . ' ' . substr($this->name_middle, 0, 1) . '.';
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
}
