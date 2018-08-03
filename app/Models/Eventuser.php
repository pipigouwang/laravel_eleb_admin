<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eventuser extends Model
{
    //
protected $gaured=[];

    //和抽奖活动相关联
    public function events()
    {
        return  $this->belongsTo(Event::class,'events_id','id');
    }
    //和商家用户相关联
    public function users()
    {
        return  $this->belongsTo(Users::class,'user_id','id');
    }
}
