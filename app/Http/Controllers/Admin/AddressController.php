<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DB\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    private $defaultRules = [
        'zip_code' => 'required',
        'street' => 'required',
        'region' => 'required',
        'city' => 'required',
        'state' => 'required',
    ];
    private $fields = [
        'zip_code',
        'street',
        'number',
        'region',
        'city',
        'state',
    ];
    private $slugRoutes = 'address';

    public function index()
    {
        $items = Address::get();
        return view('admin.' . $this->slugRoutes . '.index', compact('items'));
    }
    public function store($user, Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        $data = $request->only($this->fields);
        $data['user_id'] = $user;
        try {
            Address::create($data);
            return redirect()->route('dashboard.' . $this->slugRoutes . '.index', $user)->with('success', 'Item salvo com sucesso');
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
        $item = Address::find($id);
        return view('admin.' . $this->slugRoutes . '.show', compact('item'));
    }
    public function update($user, $id, Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        
        try {
            $item = Address::find($id);
            $data = $request->only($this->fields);
            $data['user_id'] = $user;
            $item->update($data);

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index', $user)->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function destroy($user, $id)
    {
        try {
            $item = Address::find($id);
            $item->delete();

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index', $user)->with('success', 'Item excluído com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao excluir: ' . $e->getMessage());
        }
    }
}
