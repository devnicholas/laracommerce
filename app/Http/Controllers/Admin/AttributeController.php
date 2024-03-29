<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DB\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    private $defaultRules = [
        'name' => 'required',
    ];
    private $fields = [
        'name', 'values'
    ];
    private $slugRoutes = 'attribute';

    public function index()
    {
        $items = Attribute::get();
        return view('admin.' . $this->slugRoutes . '.index', compact('items'));
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        $data = $request->only($this->fields);
        try {
            $data['values'] = json_encode(explode(', ', $data['values']));
            Attribute::create($data);
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
        $item = Attribute::find($id);
        return view('admin.' . $this->slugRoutes . '.show', compact('item'));
    }
    public function update($id, Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        
        try {
            $item = Attribute::find($id);
            $data = $request->only($this->fields);
            $data['values'] = json_encode(explode(', ', $data['values']));
            $item->update($data);

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $item = Attribute::with('products')->find($id);
            foreach ($item->products as $prod) {
                $prod->pivot->delete();
            }
            $item->delete();

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item excluído com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao excluir: ' . $e->getMessage());
        }
    }
}
