<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AddComic extends Model
{
    //
    use Notifiable;
    protected $table='mybimg';
    public $timestamps=false;
    protected $fillable=[
        'id','userid','auditid','auditto','bimgx','bimgb','bimgt',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
