<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // =====================
    // Views
    // =====================
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $query = Category::query();
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        $categories = $query->paginate($perPage)->appends(['search' => $search]);
        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('pages.categories.show', compact('category'));
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('pages.categories.edit', compact('category'));
    }

    // =====================
    // Action / APIs
    // =====================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = Category::create($validated);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = Category::findOrFail($id);
        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
