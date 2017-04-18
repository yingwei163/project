<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PowerModel extends Authenticatable
{
    protected $table='power';
    public $timestamps=false;
    protected $fillable=['name','password'];
    protected $hidden = [
        'pwd', 'remember_token',
    ];
    public function powers()
    {
        return $this->belongsToMany('App\Model\RoleModel','power_link','uid','rid');
    }


}
