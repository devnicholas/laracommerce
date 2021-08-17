<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    
    public function categories()
    {
        return $this->belongsToMany('App\Models\DB\Category')->withPivot('order')->withTimestamps();;
    }
    public function cartItems()
    {
        return $this->belongsTo('App\Models\DB\CartItem');
    }
    public function attributes()
    {
        return $this->belongsToMany('App\Models\DB\Attribute')->withPivot('value');
    }
}
