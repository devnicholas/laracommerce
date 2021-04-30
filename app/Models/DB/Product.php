<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    
    public function category()
    {
        return $this->belongsTo('App\Models\DB\Category');
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
