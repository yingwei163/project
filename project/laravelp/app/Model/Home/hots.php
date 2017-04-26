<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class hots extends Model
{
    //【暴漫】作品的评价统计数据表
    use Notifiable;
    protected $table='hots';
    protected $fillable=[
        'id',
        'created_at',
        'updated_at',
        'works_id',
        'type',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
