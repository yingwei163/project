<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class advertising extends Model
{
    protected $table='advertising';
    //过滤时间戳
    public $timestamps = false;

//    public function Exhibitors()
//    {
//        return $this->hasOne('App\Exhibitors');
//    }
}
