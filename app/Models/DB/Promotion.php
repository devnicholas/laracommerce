<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded = [];
    
    public function carts()
    {
        return $this->hasMany('App\Models\DB\Cart');
    }
}
