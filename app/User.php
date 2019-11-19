<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $incrementing = false;
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'id_user', 'nrk', 'nip', 'username', 'password', 'name', 'email', 'user_status', 'user_bidang', 'remember_token', 'created_at', 'updated_at', 'soft_delete'
    ];

    public function bidang()
    {
        return $this->hasOne('App\Bidang','id_bidang','user_bidang');
    }

    // public function subbidang()
    // {
    //     return $this->hasOne('App\Subbidang','id_subbidang','id_subbidang');
    // }

    public function subbidang()
    {
        return $this->hasOneThrough('App\User', 'App\Bidang');
    }


    public function usertype()
    {
        return $this->hasOne('App\User_type','id_userType','user_status');
    }
    
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    // /**
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // /**
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
