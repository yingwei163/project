<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class cropbool extends Model
{
    //收藏
    use Notifiable;
    protected $table='cropbool';
    protected $fillable=[
        'id',
        'user_id',
        'crop_id',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
