<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class imgmessage extends Model
{
    //【趣图】作品评论数据库
    use Notifiable;
    protected $table='imgmessage';
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
