<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menuses extends Model
{
    //
    public function shop()
    {
        return $this->belongsTo(Shops::class,'shop_id','id');
    }
}
