<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class bimgtalk extends Model
{
    //【暴漫】评论数据库
    use Notifiable;
    protected $table='bimgtalk';
    protected $fillable=[
        'id',
        'user_id',
        'work_id',
        'talk_txt',
    ];
    protected $hidden = [
        'remember_token',
    ];
    public function user()
    {
        return $this->belongsToMany('App\Model\AddComic','userinfo','work_id','user_id');
    }
}
