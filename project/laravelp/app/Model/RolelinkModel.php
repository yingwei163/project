<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RolelinkModel extends Model
{
    protected $table='role_link';
    public $timestamps=false;
    protected $fillable=['rid','aid'];
}
