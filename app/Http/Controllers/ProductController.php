<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // =====================
    // Views
    // =====================
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $query = Product::with('category');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('price', 'like', "%{$search}%")
                    ->orWhere('stock', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($qc) use ($search) {
                        $qc->where('name', 'like', "%{$search}%");
                    });
            });
        }
        $products = $query->paginate($perPage)->appends(['search' => $search]);
        return view('pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.products.create', compact('categories'));
    }

    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('pages.products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('pages.products.edit', compact('product', 'categories'));
    }

    // =====================
    // Action / APIs
    // =====================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'foto' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            $validated['photo'] = $request->file('foto')->store('products', 'public');
        }
        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }


    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'foto' => 'nullable|image|max:2048',
        ]);
        $product = Product::findOrFail($id);
        if ($request->hasFile('foto')) {
            $validated['photo'] = $request->file('foto')->store('products', 'public');
        }
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
