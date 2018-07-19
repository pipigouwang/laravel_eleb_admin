<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Users extends Model
{
//
    protected $fillable = ['name','email','head','password','shop_id','status'];
    //获取head的真实地址
    public function head(){
        return Storage::url($this->head);
    }
    //建立与商家的关系
    public function shopss()
    {

        return $this->belongsTo(Shops::class,'shop_id','id');
    }
}
