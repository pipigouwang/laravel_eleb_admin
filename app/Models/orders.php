<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    //
    public function shop()
    {
        return $this->belongsTo(Shops::class,'shop_id','id');
    }
}
