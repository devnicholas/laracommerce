<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded = [];
    protected $dates = [
        'startAt',
        'endAt',
    ];

    public function inPromotion(Int $id)
    {
        foreach(json_decode($this->products) as $prod){
            if($prod==$id){
                return true;
            }
        }
        return false;
    }
    
    public function carts()
    {
        return $this->hasMany('App\Models\DB\Cart');
    }
}
