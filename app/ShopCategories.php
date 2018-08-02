<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopCategories extends Model
{
    //
    protected $table = 'shop_categories';
    //获取head的真实地址
    public function img(){
        return Storage::url($this->img);
    }
}
