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
        'qty' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0'
    ];
    private $fields = [
        'name', 'slug', 'image', 'description', 'qty', 'price'
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
            
            if($request->input('attributes')!=null){
                $attrs = [];
                foreach($request->input('attributes') as $id => $value){
                    if($value && $value!='')
                        $attrs[$id] = ['value' => $value];
                }
                $product->attributes()->sync($attrs);
            }
            if($request->input('categories')!=null){
                $product->categories()->sync($request->input('categories'));
            }

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
        $item = Product::with(['attributes', 'categories'])->find($id);
        $categories = Category::get();
        $attributes = Attribute::get();
        return view('admin.' . $this->slugRoutes . '.show', compact('item', 'categories', 'attributes'));
    }
    public function update($id, Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        
        try {
            $item = Product::find($id);
            $data = $request->only($this->fields);
            DB::beginTransaction();
            if($request->image){
                $filename = Helper::uploadFile($request->image, 'products/');
                $data['image'] = $filename ? $filename : null;
            }
            $item->update($data);

            $attrs = [];
            if($request->input('attributes')!=null){
                foreach($request->input('attributes') as $id => $value){
                    if($value && $value!='')
                        $attrs[$id] = ['value' => $value];
                }
            }
            $item->attributes()->sync($attrs);
            if($request->input('categories')!=null){
                $item->categories()->sync($request->input('categories'));
            }

            DB::commit();
            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $item = Product::find($id);
            $item->delete();

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item excluído com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao excluir: ' . $e->getMessage());
        }
    }
}
