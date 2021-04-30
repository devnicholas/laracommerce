<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $guarded = [];
    
    public function cart()
    {
        return $this->belongsTo('App\Models\DB\Cart');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\DB\Product');
    }
}
