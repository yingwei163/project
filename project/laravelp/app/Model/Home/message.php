<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class message extends Model
{
    //【暴漫】作品评论数据库
    use Notifiable;
    protected $table='message';
    protected $fillable=[
        'id',
        'created_at',
        'updated_at',
        'works_id',
        'message_id',
        'collect',
        'talk',
        'praise',
        'rotten',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
