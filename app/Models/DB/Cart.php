<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function promotion()
    {
        return $this->belongsTo('App\Models\DB\Promotion');
    }
    public function items()
    {
        return $this->hasMany('App\Models\DB\CartItem');
    }

}
