<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DB\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $defaultRules = [
        'name' => 'required',
    ];
    private $fields = [
        'name'
    ];
    private $slugRoutes = 'category';

    public function index()
    {
        $items = Category::get();
        return view('admin.' . $this->slugRoutes . '.index', compact('items'));
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        $data = $request->only($this->fields);
        try {
            Category::create($data);
            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function create()
    {
        return view('admin.' . $this->slugRoutes . '.create');
    }
    public function show($id)
    {
        $item = Category::find($id);
        return view('admin.' . $this->slugRoutes . '.show', compact('item'));
    }
    public function update($id, Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        
        try {
            $item = Category::find($id);
            $data = $request->only($this->fields);
            $item->update($data);

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $item = Category::find($id);
            $item->delete();

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item excluído com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao excluir: ' . $e->getMessage());
        }
    }
    public function order($id)
    {
        $category = Category::with('products', 'groupProducts')->find($id);
        if(!$category) 
            return redirect()->back()->with('error', 'Não foi possível encontrar a categoria especificada');

        $items = array_merge($category->products->toArray(), $category->groupProducts->toArray());
        usort($items, function ($it1, $it2){
            return $it1['pivot']['order'] > $it2['pivot']['order'] ? 1 : -1;
        });
        
        return view('admin.' . $this->slugRoutes . '.order', compact('category','items'));
    }
    public function orderStore($id, Request $request)
    {
        $category = Category::with('products', 'groupProducts')->find($id);
        if(!$category) 
            return abort(404, 'Category not found');

        try {
            $group = [];
            $single = [];
            foreach($request->items as $order => $data){
                if($data[1] === 'group'){
                    $group[$data[0]] = ['order' => $order+1];
                }else{
                    $single[$data[0]] = ['order' => $order+1];
                }
            }
            $category->products()->sync($single);
            $category->groupProducts()->sync($group);

            return ['success'];
        } catch (\Throwable $th) {
            return abort(500, 'On error ocorred');
        }
        
    }
}
