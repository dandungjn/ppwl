<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->applyResourcePermissions('positions');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Position::datatable();
        }
        return view('pages.positions.index');
    }

    public function create()
    {
        return view('pages.positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'level' => 'required|string|max:50',
        ]);
        Position::create($request->all());
        return redirect()->route('positions.index')->with('success', 'Position created successfully.');
    }

    public function show($id)
    {
        $position = Position::findOrFail($id);
        return view('pages.positions.show', compact('position'));
    }

    public function edit($id)
    {
        $position = Position::findOrFail($id);
        return view('pages.positions.edit', compact('position'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'level' => 'required|string|max:50',
        ]);
        $position = Position::findOrFail($id);
        $position->update($request->all());
        return redirect()->route('positions.index')->with('success', 'Position updated successfully.');
    }

    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Position deleted successfully.');
    }
}
