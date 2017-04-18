<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PowerlinkModel extends Model
{
    protected $table='power_link';
    public $timestamps=false;
    protected $fillable=['uid','rid'];
}
