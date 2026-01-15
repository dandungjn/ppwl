<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankRequest;
use App\Models\Bank;
use Illuminate\Http\Request;

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

    public function store(BankRequest $request)
    {
        Bank::create($request->validated());

        return redirect()
            ->route('banks.index')
            ->with('success', 'Bank created successfully.');
    }

    public function show(Bank $bank)
    {
        return view('pages.banks.show', compact('bank'));
    }

    public function edit(Bank $bank)
    {
        return view('pages.banks.edit', compact('bank'));
    }

    public function update(BankRequest $request, Bank $bank)
    {
        $bank->update($request->validated());

        return redirect()
            ->route('banks.index')
            ->with('success', 'Bank updated successfully.');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();

        return redirect()
            ->route('banks.index')
            ->with('success', 'Bank deleted successfully.');
    }
}
