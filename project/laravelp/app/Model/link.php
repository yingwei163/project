<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class link extends Model
{
    protected $table='link';
    //过滤时间戳
    public $timestamps = false;
}
