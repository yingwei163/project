<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use Notifiable;

    protected $table='y_user';
    public $timestamps=false;
    protected $fillable=['name','email','pwd'];
    protected $hidden = [
        'pwd', 'remember_token',
    ];

}
