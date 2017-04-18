<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table='role';
    public $timestamps=false;
    protected $fillable=['name','roletake'];
    public function roles()
    {
        return $this->belongsToMany('App\Model\AttachModel','role_link','rid','aid');
    }
}
