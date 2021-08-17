<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\DB\Category;
use App\Models\DB\GroupProduct;
use App\Models\DB\Product;
use Illuminate\Http\Request;

class GroupProductController extends Controller
{
    private $defaultRules = [
        'name' => 'required',
        'slug' => 'required',
    ];
    private $fields = [
        'name', 'slug', 'image', 'description', 'products'
    ];
    private $slugRoutes = 'group-product';

    public function index()
    {
        $items = GroupProduct::get();
        
        return view('admin.' . $this->slugRoutes . '.index', compact('items'));
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        $data = $request->only($this->fields);
        try {
            if(count($data['products'])){
                $data['products'] = json_encode($data['products']);
            }
            if($request->image){
                $filename = Helper::uploadFile($request->image, 'products/');
                $data['image'] = $filename ? $filename : null;
            }
            
            $newProduct = GroupProduct::create($data);
            if($request->input('categories')!=null){
                $newProduct->categories()->sync($request->input('categories'));
            }
            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function create()
    {
        $products = Product::get();
        $categories = Category::get();
        return view('admin.' . $this->slugRoutes . '.create', compact('categories', 'products'));
    }
    public function show($id)
    {
        $item = GroupProduct::with('categories')->find($id);
        $categories = Category::get();
        $products = Product::get();
        return view('admin.' . $this->slugRoutes . '.show', compact('item', 'categories', 'products'));
    }
    public function update($id, Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        
        try {
            $item = GroupProduct::find($id);
            $data = $request->only($this->fields);

            if($request->image){
                $filename = Helper::uploadFile($request->image, 'products/');
                $data['image'] = $filename ? $filename : null;
            }

            $item->update($data);
            if($request->input('categories')!=null){
                $item->categories()->sync($request->input('categories'));
            }

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $item = GroupProduct::find($id);
            $item->delete();

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item excluído com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao excluir: ' . $e->getMessage());
        }
    }
}
