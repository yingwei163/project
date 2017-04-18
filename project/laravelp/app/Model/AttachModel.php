<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttachModel extends Model
{
    protected $table='attach';
    public $timestamps=false;
    protected $fillable=['name','route','routetake'];
}
