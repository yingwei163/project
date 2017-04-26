<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class crops extends Model
{
    //收藏
    use Notifiable;
    protected $table='crops';
    protected $fillable=[
        'id',
        'works_id',
        'works_title',
        'works_icon',
        'user_id',
        'user_name',
        'user_icon',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
