<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
