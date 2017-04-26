<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class exhibitors extends Model
{
    protected $table='exhibitors';
    //过滤时间戳
    public $timestamps = false;
}
