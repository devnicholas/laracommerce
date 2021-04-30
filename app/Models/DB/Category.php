<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany('App\Models\DB\Product');
    }
}
