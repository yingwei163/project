<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class myvideo extends Model
{
    protected $table='myvideo';
    public $timestamps=false;
    protected $fillable=['userid','videox','videob','videot','name','image'];

}
