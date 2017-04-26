<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class imgtalk extends Model
{
    //【暴漫】评论数据库
    use Notifiable;
    protected $table='imgtalk';
    protected $fillable=[
        'id',
        'user_id',
        'work_id',
        'talk_txt',
    ];
    protected $hidden = [
        'remember_token',
    ];

}