<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use App\Models\Bank;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->applyResourcePermissions('companies');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Company::datatable();
        }

        return view('pages.companies.index');
    }

    public function create()
    {
        $banks = Bank::pluck('name', 'id')->toArray();
        return view('pages.companies.create', compact('banks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'acronym' => 'required|string|max:100',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'tax_number' => 'required|string|max:25',
            'leader_name' => 'required|string|max:255',
            'bank_id' => 'required|exists:banks,id',
            'tax_status' => 'required|string|max:10',
            'status' => 'nullable|integer',
            'logo_header' => 'nullable|image|max:2048',
            'logo_stamp' => 'nullable|image|max:2048',
            'logo_signature' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('logo_header')) {
            $data['logo_header'] = Storage::disk('public')->putFile('company', $request->file('logo_header'));
        }
        if ($request->hasFile('logo_stamp')) {
            $data['logo_stamp'] = Storage::disk('public')->putFile('company', $request->file('logo_stamp'));
        }
        if ($request->hasFile('logo_signature')) {
            $data['logo_signature'] = Storage::disk('public')->putFile('company', $request->file('logo_signature'));
        }

        Company::create($data);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $banks = Bank::pluck('name', 'id')->toArray();
        return view('pages.companies.edit', compact('company', 'banks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'acronym' => 'required|string|max:100',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'tax_number' => 'required|string|max:25',
            'leader_name' => 'required|string|max:255',
            'bank_id' => 'required|exists:banks,id',
            'tax_status' => 'required|string|max:10',
            'status' => 'nullable|integer',
            'logo_header' => 'nullable|image|max:2048',
            'logo_stamp' => 'nullable|image|max:2048',
            'logo_signature' => 'nullable|image|max:2048',
        ]);

        $company = Company::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('logo_header')) {
            if ($company->logo_header) {
                Storage::disk('public')->delete($company->logo_header);
            }
            $data['logo_header'] = Storage::disk('public')->putFile('company', $request->file('logo_header'));
        }
        if ($request->hasFile('logo_stamp')) {
            if ($company->logo_stamp) {
                Storage::disk('public')->delete($company->logo_stamp);
            }
            $data['logo_stamp'] = Storage::disk('public')->putFile('company', $request->file('logo_stamp'));
        }
        if ($request->hasFile('logo_signature')) {
            if ($company->logo_signature) {
                Storage::disk('public')->delete($company->logo_signature);
            }
            $data['logo_signature'] = Storage::disk('public')->putFile('company', $request->file('logo_signature'));
        }

        $company->update($data);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
