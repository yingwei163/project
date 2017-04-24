<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CUST extends Model
{
    protected $table='cust';
    //过滤时间戳
    public $timestamps = false;
}
