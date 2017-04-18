<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class collect extends Model
{
    //【暴漫】作品的评价统计数据表
    use Notifiable;
    protected $table='collect';
    protected $fillable=[
        'id',
        'created_at',
        'updated_at',
        'works_id',
        'collects',
        'talks',
        'praises',
        'rottens',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
