<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'name_first', 'name_middle', 'name_last', 'name_suffix', 'gender', 'date_birth', 'email', 'password',
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
     * The attributes that connects to verify user table.
     *
     * @return App\VerfiyUser
     */
    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }
}
