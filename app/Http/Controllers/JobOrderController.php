<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Quotation;

class JobOrderController extends Controller
{
    public function __construct()
    {
        $this->applyResourcePermissions('job-orders');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return JobOrder::datatable(null, [
                'extra_columns' => [
                    'client_name' => fn($row) => $row->client?->name,
                    'quotation_attention' => fn($row) => $row->quotation?->attention_name,
                ],
            ]);
        }

        return view('pages.jobOrders.index');
    }

    public function create()
    {
        $clientOptions = Client::orderBy('name')->pluck('name', 'id')->toArray();
        $quotationOptions = Quotation::orderBy('created_at', 'desc')
            ->get()
            ->mapWithKeys(fn($q) => [$q->id => ($q->attention_name ?: '-') . ($q->number ? " ({$q->number})" : '')])
            ->toArray();

        return view('pages.jobOrders.create', compact('clientOptions', 'quotationOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'spk_number' => 'nullable|string|max:255',
            'spk_date' => 'nullable|date',
            'contract_value' => 'nullable|numeric',
            'client_id' => 'nullable|exists:clients,id',
            'company_id' => 'nullable|exists:companies,id',
            'quotation_id' => 'nullable|exists:quotations,id',
            'payment_method' => 'nullable|string|max:255',
            'tax_status' => 'nullable|string|max:255',
            'contract_type' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'project_status' => 'nullable|string|max:255',
        ]);

        JobOrder::create($request->all());

        return redirect()->route('job-orders.index')->with('success', 'Job Order created successfully.');
    }

    public function show($id)
    {
        $jobOrder = JobOrder::findOrFail($id);
        return view('pages.jobOrders.show', compact('jobOrder'));
    }

    public function edit($id)
    {
        $jobOrder = JobOrder::findOrFail($id);
        $clientOptions = Client::orderBy('name')->pluck('name', 'id')->toArray();
        $quotationOptions = Quotation::orderBy('created_at', 'desc')
            ->get()
            ->mapWithKeys(fn($q) => [$q->id => ($q->attention_name ?: '-') . ($q->number ? " ({$q->number})" : '')])
            ->toArray();

        return view('pages.jobOrders.edit', compact('jobOrder', 'clientOptions', 'quotationOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'spk_number' => 'nullable|string|max:255',
            'spk_date' => 'nullable|date',
            'contract_value' => 'nullable|numeric',
            'client_id' => 'nullable|exists:clients,id',
            'company_id' => 'nullable|exists:companies,id',
            'quotation_id' => 'nullable|exists:quotations,id',
            'payment_method' => 'nullable|string|max:255',
            'tax_status' => 'nullable|string|max:255',
            'contract_type' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'project_status' => 'nullable|string|max:255',
        ]);

        $jobOrder = JobOrder::findOrFail($id);
        $jobOrder->update($request->all());

        return redirect()->route('job-orders.index')->with('success', 'Job Order updated successfully.');
    }

    public function destroy($id)
    {
        $jobOrder = JobOrder::findOrFail($id);
        $jobOrder->delete();
        return redirect()->route('job-orders.index')->with('success', 'Job Order deleted successfully.');
    }
}
