<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DB\Order;
use App\Models\DB\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $slugRoutes = 'order';

    public function index()
    {
        $items = Order::get();
        return view('admin.' . $this->slugRoutes . '.index', compact('items'));
    }
    public function show($id)
    {
        $item = Order::find($id);
        return view('admin.' . $this->slugRoutes . '.show', compact('item'));
    }
    public function update($id, $status)
    {        
        try {
            $item = Order::find($id);
            $item->status = $status;
            $item->save();
            if($status=='completed'){
                foreach(json_decode($item->products_data) as $prod){
                    $product = Product::find($prod->id);
                    if($product && $product->qty>0){
                        $product->qty = $product->qty-1;
                        $product->save();
                    }
                }
            }

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
}
