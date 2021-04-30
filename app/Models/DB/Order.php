<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    
    public function address()
    {
        return $this->belongsTo('App\Models\DB\Promotion');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
