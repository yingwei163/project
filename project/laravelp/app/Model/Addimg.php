<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Addimg extends Model
{
    //
    use Notifiable;
    protected $table='myimg';
    public $timestamps=false;
    protected $fillable=[
        'id','userid','auditid','auditto','imgx','imgb','imgt',
    ];
    protected $hidden = [
        'remember_token',
    ];
    public function collect()
    {
        return $this->belongsTo('App\Model\Home\imgcollect','id','works_id');
    }
    public function users()
    {

        return $this->belongsToMany('App\Model\Home\imgcollect','imgmessage','id','works_id');

    }
}
