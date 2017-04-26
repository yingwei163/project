<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CUST extends Model
{
    protected $table='cuth';
    //过滤时间戳
    public $timestamps = false;
}
