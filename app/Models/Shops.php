<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Shops extends Model
{
    //
//允许赋值和修改的字段
    protected $fillable = [
        'shop_category_id','shop_name','shop_img', 'shop_rating', 'brand','on_time','fengniao',
        'bao', 'piao','zhun', 'start_send','send_cost','notice','discount', 'status'
    ];
    public function shop_img(){
        return Storage::url($this->shop_img);
    }
    //建立与商家分类的关系
    public function shopscate()
    {
        return $this->belongsTo(Shopscategory::class,'shop_category_id','id');
        //Student::class ==== 'App\Models\Student'
    }
}
