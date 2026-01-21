<?php

namespace App\Http\Controllers;

use App\Http\Requests\FurnitureRequest;
use App\Models\Category;
use App\Models\Furniture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class FurnitureController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Furniture::query();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return view('components.ui.image-thumb', ['src' => $row->image])->render();
                })
                ->addColumn('action', function ($row) {
                    $modelName = class_basename($row);
                    $kebab = Str::kebab($modelName);
                    $plural = Str::plural($kebab);

                    $editUrl = route("$plural.edit", $row->id);
                    $deleteUrl = route("$plural.destroy", $row->id);

                    return '
                        <a href="' . $editUrl . '" class="h3 text-info mb-0 me-2">
                            <i class="mdi mdi-pencil"></i>
                        </a>

                        <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit"
                                class="h3 border-0 bg-transparent text-danger mb-0 btn-confirm"
                                data-title="Delete ' . ucfirst($kebab) . '"
                                data-text="Are you sure you want to delete this ' . $kebab . '?"
                            >
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        return view('pages.furnitures.index');
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');

        return view('pages.furnitures.create', compact('categories'));
    }

    public function store(FurnitureRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('furnitures', 'public');
        }

        Furniture::create($data);

        return redirect()->route('furniture.index')->with('success', 'Furniture created successfully.');
    }

    public function edit(Furniture $furniture)
    {
        $categories = Category::pluck('name', 'id');

        return view('pages.furnitures.edit', compact('furniture', 'categories'));
    }

    public function update(FurnitureRequest $request, Furniture $furniture)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($furniture->image) {
                Storage::disk('public')->delete($furniture->image);
            }
            $data['image'] = $request->file('image')->store('furnitures', 'public');
        }

        $furniture->update($data);

        return redirect()->route('furniture.index')->with('success', 'Furniture updated successfully.');
    }

    public function destroy(Furniture $furniture)
    {
        if ($furniture->image) {
            Storage::disk('public')->delete($furniture->image);
        }

        $furniture->delete();

        return redirect()->route('furniture.index')->with('success', 'Furniture deleted successfully.');
    }
}
