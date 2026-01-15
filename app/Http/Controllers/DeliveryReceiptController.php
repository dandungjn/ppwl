<?php

namespace App\Http\Controllers;

use App\Models\DeliveryReceipt;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PdfService;

class DeliveryReceiptController extends Controller
{
    protected array $rules = [
        'description'   => 'nullable|string',
        'received_date' => 'nullable|date',
        'receiver_name' => 'required|string|max:255',
        'sender_name'   => 'required|string|max:255',
        'status'        => 'required|in:1,2,3,9',
    ];

    public function __construct()
    {
        if (method_exists($this, 'applyResourcePermissions')) {
            $this->applyResourcePermissions('delivery-receipts');
        }
    }

    private function fmtDate($value): string
    {
        if (empty($value)) return '-';
        try {
            return ($value instanceof \Carbon\Carbon ? $value : \Carbon\Carbon::parse($value))->format('Y-m-d');
        } catch (\Exception $e) {
            return '-';
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = DeliveryReceipt::with(['uploadedBy'])->select('delivery_receipts.*');

            return DeliveryReceipt::datatable($query, [
                'extra_columns' => [
                    'received_date' => fn($row) => $this->fmtDate($row->received_date),
                    'receiver_name' => fn($row) => $row->receiver_name ?: '-',
                    'sender_name'   => fn($row) => $row->sender_name ?: '-',
                    'status'        => fn($row) => match($row->status) {
                        1 => 'Open',
                        2 => 'In Transit',
                        3 => 'Completed',
                        9 => 'Cancelled',
                        default => $row->status
                    },
                    'uploaded_by' => fn($row) => $row->uploadedBy?->name ?? '-',
                ],
            ]);
        }

        return view('pages.deliveryReceipts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::pluck('name', 'id')->toArray();
        return view('pages.deliveryReceipts.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->rules);
        $data['uploaded_by'] = Auth::id();

        DeliveryReceipt::create($data);

        return redirect()->route('delivery-receipts.index')->with('success', 'Delivery Receipt created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $companies = Company::pluck('name', 'id')->toArray();
        $receipt = DeliveryReceipt::findOrFail($id);
        return view('pages.deliveryReceipts.edit', compact('receipt', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate($this->rules);
        $data['uploaded_by'] = DeliveryReceipt::findOrFail($id)->uploaded_by;

        DeliveryReceipt::findOrFail($id)->update($data);

        return redirect()->route('delivery-receipts.index')->with('success', 'Delivery Receipt updated successfully.');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($id)
    {
        DeliveryReceipt::findOrFail($id)->delete();
        return redirect()->route('delivery-receipts.index')->with('success', 'Delivery Receipt deleted successfully.');
    }

    /**
     * Generate and download PDF for a delivery receipt.
     */
    public function downloadPdf($id)
    {
        $receipt = DeliveryReceipt::with('uploadedBy')->findOrFail($id);
        $filename = "DeliveryReceipt-{$receipt->id}.pdf";

        return PdfService::download(
            'pdf.delivery_receipt',
            ['receipt' => $receipt],
            $filename
        );
    }

    /**
     * Stream PDF for preview in browser.
     */
    public function previewPdf($id)
    {
        $receipt = DeliveryReceipt::with('uploadedBy')->findOrFail($id);

        return PdfService::stream(
            'pdf.delivery_receipt',
            ['receipt' => $receipt]
        );
    }
}
