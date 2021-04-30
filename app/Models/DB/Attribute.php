<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $guarded = [];
    
    public function products()
    {
        return $this->belongsToMany('App\Models\DB\Product')->withPivot('value');
    }
}
