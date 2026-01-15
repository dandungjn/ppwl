<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->applyResourcePermissions('items');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Item::datatable();
        }

        return view('pages.items.index');
    }

    public function create()
    {
        return view('pages.items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'  => 'required|string|max:20',
            'name'  => 'required|string|max:50',
            'label' => 'required|string|max:50',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('pages.items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type'  => 'required|string|max:20',
            'name'  => 'required|string|max:50',
            'label' => 'required|string|max:50',
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
