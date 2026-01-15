<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->applyResourcePermissions('employees');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Employee::datatable();
        }

        return view('pages.employees.index');
    }

    public function create()
    {
        return view('pages.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:50',
            'birth_place' => 'required|string|max:30',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'position' => 'required|string|max:50',
            'file_path' => 'nullable|file|max:5120',
            'status' => 'required|boolean',
        ]);

        $data = $request->all();
        if ($request->hasFile('file_path')) {
            $data['file_path'] = Storage::disk('public')->putFile('employee', $request->file('file_path'));
        }

        Employee::create($data);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('pages.employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:50',
            'birth_place' => 'required|string|max:30',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'position' => 'required|string|max:50',
            'file_path' => 'nullable|file|max:5120',
            'status' => 'required|boolean',
        ]);

        $employee = Employee::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('file_path')) {
            if ($employee->file_path) {
                Storage::disk('public')->delete($employee->file_path);
            }
            $data['file_path'] = Storage::disk('public')->putFile('employee', $request->file('file_path'));
        }

        if ($request->user()) {
            $data['updated_by'] = $request->user()->id;
        }

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        if ($employee->file_path) {
            Storage::disk('public')->delete($employee->file_path);
        }
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
