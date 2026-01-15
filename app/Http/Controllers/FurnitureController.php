<?php

namespace App\Http\Controllers;

use App\Http\Requests\FurnitureRequest;
use App\Models\Category;
use App\Models\Furniture;
use Illuminate\Http\Request;

class FurnitureController extends Controller
{
    public function __construct()
    {
        $this->applyResourcePermissions('furnitures');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Furniture::datatable();
        }

        return view('pages.furniture.index');
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');

        return view('pages.furniture.create', compact('categories'));
    }

    public function store(FurnitureRequest $request)
    {
        Furniture::create($request->validated());

        return redirect()->route('furniture.index')->with('success', 'Furniture created successfully.');
    }

    public function edit(Furniture $furniture)
    {
        $categories = Category::pluck('name', 'id');

        return view('pages.furniture.edit', compact('furniture', 'categories'));
    }

    public function update(FurnitureRequest $request, Furniture $furniture)
    {
        $furniture->update($request->validated());

        return redirect()->route('furniture.index')->with('success', 'Furniture updated successfully.');
    }

    public function destroy(Furniture $furniture)
    {
        $furniture->delete();

        return redirect()->route('furniture.index')->with('success', 'Furniture deleted successfully.');
    }
}
