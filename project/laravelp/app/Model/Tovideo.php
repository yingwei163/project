<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tovideo extends Model
{
    protected $table='invideo';
    public $timestamps=false;
    protected $primaryKey='videoid';
    protected $fillable=['videoid','videob','name','images','tovideo'];
}
