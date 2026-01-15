<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->applyResourcePermissions('blogs');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Blog::datatable();
        }
        return view('pages.blogs.index');
    }

    public function create()
    {
        return view('pages.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:200',
            'file_path' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ]);
        $data = $request->all();
        $data['uploaded_by'] = $request->user()->id;
        if ($request->hasFile('file_path')) {
            $data['file_path'] = Storage::disk('public')->putFile('blog', $request->file('file_path'));
        } else {
            $data['file_path'] = 'assets/images/blog/default.png';
        }
        Blog::create($data);
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('pages.blogs.show', compact('blog'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('pages.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:200',
            'file_path' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ]);
        $blog = Blog::findOrFail($id);
        $data = $request->all();
        $data['uploaded_by'] = $request->user()->id;
        if ($request->hasFile('file_path')) {
            // delete old file if exists and not default
            if ($blog->file_path && $blog->file_path !== 'assets/images/blog/default.png') {
                Storage::disk('public')->delete($blog->file_path);
            }
            $data['file_path'] = Storage::disk('public')->putFile('blog', $request->file('file_path'));
        }
        $blog->update($data);
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        // delete file if exists and not default
        if ($blog->file_path && $blog->file_path !== 'assets/images/blog/default.png') {
            Storage::disk('public')->delete($blog->file_path);
        }
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
