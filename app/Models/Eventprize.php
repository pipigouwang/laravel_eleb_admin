<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eventprize extends Model
{
    protected $fillable=['event_id','name','description','user_id','id'];
    //和抽奖活动相关联
    public function events()
    {
        return  $this->belongsTo(Event::class,'event_id','id');
    }
    //和商家用户相关联
    public function users()
    {
        return  $this->belongsTo(Users::class,'user_id','id');
    }
}
