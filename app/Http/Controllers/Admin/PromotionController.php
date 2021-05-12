<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DB\Product;
use App\Models\DB\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    private $defaultRules = [
        'type' => 'required',
        'value' => 'required',
    ];
    private $fields = [
        'automatic', 'coupon', 'products', 'startAt', 'endAt', 'limit', 'type', 'value'
    ];
    private $slugRoutes = 'promotion';

    public function index()
    {
        $items = Promotion::get();
        return view('admin.' . $this->slugRoutes . '.index', compact('items'));
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        $data = $request->only($this->fields);
        try {
            if($request->input('automatic')){
                $data['automatic'] = true;
            }else{
                $data['automatic'] = false;
            }
            if(count($data['products'])){
                $data['products'] = json_encode($data['products']);
            }
            Promotion::create($data);
            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function create()
    {
        $products = Product::get();
        return view('admin.' . $this->slugRoutes . '.create', compact('products'));
    }
    public function show($id)
    {
        $item = Promotion::find($id);
        $products = Product::get();
        return view('admin.' . $this->slugRoutes . '.show', compact('item', 'products'));
    }
    public function update($id, Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);

        try {
            $item = Promotion::find($id);
            $data = $request->only($this->fields);
            if($request->input('automatic')){
                $data['automatic'] = true;
            }else{
                $data['automatic'] = false;
            }
            if(count($data['products'])){
                $data['products'] = json_encode($data['products']);
            }
            $item->update($data);

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $item = Promotion::find($id);
            $item->delete();

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item excluído com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao excluir: ' . $e->getMessage());
        }
    }
}
