<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends Controller
{
    public function __construct()
    {
        $this->applyResourcePermissions('banks');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Bank::datatable();
        }

        return view('pages.banks.index');
    }

    public function create()
    {
        return view('pages.banks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'account_number' => 'required|string|max:50',
            'account_holder' => 'required|string|max:50',
            'status' => 'required|integer',
        ]);
        Bank::create($request->all());
        return redirect()->route('banks.index')->with('success', 'Bank created successfully.');
    }

    public function show($id)
    {
        $bank = Bank::findOrFail($id);
        return view('pages.banks.show', compact('bank'));
    }

    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
        return view('pages.banks.edit', compact('bank'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'account_number' => 'required|string|max:50',
            'account_holder' => 'required|string|max:50',
            'status' => 'required|integer',
        ]);
        $bank = Bank::findOrFail($id);
        $bank->update($request->all());
        return redirect()->route('banks.index')->with('success', 'Bank updated successfully.');
    }

    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();
        return redirect()->route('banks.index')->with('success', 'Bank deleted successfully.');
    }
}
