<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Shopscategory extends Model
{
    //
    protected $filltable='shopcategories';
    protected $fillable=['name','status','img'];

    public function img(){
        return Storage::url($this->img);
    }
}
