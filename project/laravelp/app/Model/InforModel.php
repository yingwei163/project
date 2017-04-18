<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InforModel extends Model
{
    protected $table='userinfo';
    protected $fillable=['uid','phone','icon','bir','addr','sex','foll','fan','clan','cash','comm','total','join','idea','created_at','updated_at'];
}
