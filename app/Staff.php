<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    use Notifiable;
// The authentication guard for admin
    protected $guard = 'staff';
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
    protected $fillable = [
        'email', 'password',
    ];


    protected $table = "staff";

     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
    protected $hidden = [
        'password', 'remember_token',
    ];
}