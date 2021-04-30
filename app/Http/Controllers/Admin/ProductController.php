<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\DB\Attribute;
use App\Models\DB\Category;
use App\Models\DB\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $defaultRules = [
        'name' => 'required',
        'slug' => 'required',
        'qty' => 'integer|min:0',
        'price' => 'numeric|min:0'
    ];
    private $fields = [
        'name', 'slug', 'image', 'description', 'qty', 'price', 'category_id'
    ];
    private $slugRoutes = 'product';

    public function index()
    {
        $items = Product::get();
        return view('admin.' . $this->slugRoutes . '.index', compact('items'));
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        $data = $request->only($this->fields);

        try {
            DB::beginTransaction();
            if($request->image){
                $filename = Helper::uploadFile($request->image, 'products/');
                $data['image'] = $filename ? $filename : null;
            }
            $product = Product::create($data);
            $product->attributes()->sync($request->input('attributes'));
            DB::commit();
            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function create()
    {
        $categories = Category::get();
        $attributes = Attribute::get();
        return view('admin.' . $this->slugRoutes . '.create', compact('categories', 'attributes'));
    }
    public function show($id)
    {
        $item = Product::with('attributes')->find($id);
        $categories = Category::get();
        $attributes = Attribute::get();
        return view('admin.' . $this->slugRoutes . '.show', compact('item', 'categories', 'attributes'));
    }
    public function update($id, Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        $item = Product::find($id);
        $data = $request->only($this->fields);
        
        try {
            if($request->image){
                $filename = Helper::uploadFile($request->image, 'products/');
                $data['image'] = $filename ? $filename : null;
            }
            $item->update($data);
            $item->attributes()->sync($request->input('attributes'));

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar');
        }
    }
    public function destroy($id)
    {
        $item = Product::find($id);
        try {
            $item->delete();

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item excluído com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao excluir');
        }
    }
}