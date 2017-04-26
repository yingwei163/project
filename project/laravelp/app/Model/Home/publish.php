<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class publish extends Model
{
    use Notifiable;
    protected $table='publish';
    //【暴漫】连载数据库
    protected $fillable=[
        'id',
        'created_at',
        'updated_at',
        'user_id',
        'bimg_id',
        'icons',
        'names',
        'cover',
        'title',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
