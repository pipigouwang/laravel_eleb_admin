<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public function menu()
    {
        return $this->belongsTo(Menuses::class,'shop_id','id');
    }
}
