<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany('App\Models\DB\Product')->withPivot('order')->withTimestamps();;
    }
    public function groupProducts()
    {
        return $this->belongsToMany('App\Models\DB\GroupProduct', 'category_product')->withPivot('order')->withTimestamps();;
    }
}
