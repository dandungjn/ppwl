<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Expense;

class ExpenseController extends Controller
{
    protected array $rules = [
        'number' => 'required|string|max:8',
        'date' => 'required|date',
        'category' => 'required|integer',
        'description' => 'required|string|max:225',
        'amount' => 'required|numeric',
    ];

    public function __construct()
    {
        $this->applyResourcePermissions('expenses');
    }

    private function fmtDate($value): string
    {
        if (empty($value)) return '-';
        try {
            return ($value instanceof Carbon ? $value : Carbon::parse($value))->format('Y-m-d');
        } catch (\Exception $e) {
            return '-';
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Expense::with(['user', 'userModified'])->select('expenses.*');

            return Expense::datatable($query, [
                'extra_columns' => [
                    'number' => fn($row) => $row->number ?? '-',
                    'date' => fn($row) => $this->fmtDate($row->date),
                    'category' => fn($row) => $row->category ?? '-',
                    'description' => fn($row) => $row->description ?? '-',
                    'amount' => fn($row) => $row->amount !== null ? number_format($row->amount, 2, ',', '.') : '-',
                    'user' => fn($row) => $row->user?->name ?? '-',
                    'user_modified' => fn($row) => $row->userModified?->name ?? '-',
                ],
            ]);
        }

        return view('pages.expenses.index');
    }

    public function create()
    {
        return view('pages.expenses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules);
        $data['user_id'] = auth()->id();

        Expense::create($data);

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        return view('pages.expenses.edit', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate($this->rules);
        $data['user_modified_id'] = auth()->id();

        Expense::findOrFail($id)->update($data);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy($id)
    {
        Expense::findOrFail($id)->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
