<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class GroupProduct extends Model
{
    protected $guarded = [];

    public function inGroup(Int $id)
    {
        foreach(json_decode($this->products) as $prod){
            if($prod==$id){
                return true;
            }
        }
        return false;
    }

    public function getProducts()
    {
        $products = [];
        foreach(json_decode($this->products) as $prod){
            $products[] = Product::find($prod);
        }
        return $products;
    }
}
