<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\Client;
use App\Models\Company;
use App\Services\PdfService;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    protected array $rules = [
        'number' => 'nullable|string|max:30',
        'subject' => 'nullable|string|max:50',
        'date' => 'nullable|date',
        'client_id' => 'nullable|exists:clients,id',
        'attention_name' => 'nullable|string|max:30',
        'job_description' => 'nullable|string|max:225',
        'company_id' => 'nullable|exists:companies,id',
        'status' => 'required|in:0,1',
        'items' => 'nullable|array',
        'items.*.item' => 'nullable|string|max:255',
        'items.*.qty' => 'nullable|numeric|min:0',
        'items.*.satuan' => 'nullable|numeric|min:0',
        'items.*.purchase_price' => 'nullable|numeric|min:0',
        'items.*.total_price' => 'nullable|numeric|min:0',
        'items.*.up_price' => 'nullable|numeric|min:0',
        'items.*.price_plus' => 'nullable|numeric|min:0',
        'items.*.selling_price' => 'nullable|numeric|min:0',
    ];

    public function __construct()
    {
        $this->applyResourcePermissions('quotations');
    }

    private function fmtDate($value): string
    {
        if (empty($value))
            return '-';
        try {
            return ($value instanceof \Carbon\Carbon ? $value : \Carbon\Carbon::parse($value))->format('Y-m-d');
        } catch (\Exception $e) {
            return '-';
        }
    }

    private function romanMonth(?int $month = null): string
    {
        $month = $month ?: intval(date('n'));
        $map = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII',
        ];
        return $map[$month] ?? '';
    }

    private function generateQuotationNumber(): string
    {
        $year = intval(date('Y'));
        $roman = $this->romanMonth();
        $suffix = "/SPH/$roman/$year";

        $last = Quotation::where('number', 'like', "%$suffix")
            ->orderByDesc('id')
            ->value('number');

        $next = 1;
        if (!empty($last)) {
            $parts = explode('/', $last);
            $num = intval($parts[0] ?? '0');
            if ($num > 0) {
                $next = $num + 1;
            }
        }

        return str_pad((string)$next, 3, '0', STR_PAD_LEFT) . $suffix;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Quotation::with(['client', 'company', 'uploadedBy', 'modifiedBy'])->select('quotations.*');

            return Quotation::datatable($query, [
                'extra_columns' => [
                    'number' => fn($row) => $row->number ?? '-',
                    'subject' => fn($row) => $row->subject ?? '-',
                    'date' => fn($row) => $this->fmtDate($row->date),
                    'client' => fn($row) => $row->client?->name ?? '-',
                    'attention_name' => fn($row) => $row->attention_name ?? '-',
                    'job_description' => fn($row) => $row->job_description ?? '-',
                    'company' => fn($row) => $row->company?->name ?? '-',
                    'status' => function ($row) {
                        return $row->status ? 'Aktif' : 'Tidak Aktif';
                    },
                    'uploaded_by' => fn($row) => $row->uploadedBy?->name ?? '-',
                    'modified_by' => fn($row) => $row->modifiedBy?->name ?? '-',
                ],
            ]);
        }

        return view('pages.quotations.index');
    }

    public function create()
    {
        $clientOptions = Client::orderBy('name')->pluck('name', 'id')->toArray();
        $companyOptions = Company::orderBy('name')->pluck('name', 'id')->toArray();

        $autoNumber = $this->generateQuotationNumber();

        return view('pages.quotations.create', compact('clientOptions', 'companyOptions', 'autoNumber'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules);
        if (empty($data['number'])) {
            $data['number'] = $this->generateQuotationNumber();
        }
        $data['uploaded_by'] = auth()->id();

        $items = $data['items'] ?? [];
        unset($data['items']);

        $quotation = Quotation::create($data);

        // Save quotation items
        if (!empty($items)) {
            foreach ($items as $item) {
                if (!empty($item['item'])) {
                    $quotation->items()->create([
                        'item' => $item['item'] ?? null,
                        'qty' => $item['qty'] ?? 0,
                        'satuan' => $item['satuan'] ?? 0,
                        'purchase_price' => $item['purchase_price'] ?? 0,
                        'total_price' => $item['total_price'] ?? 0,
                        'up_price' => $item['up_price'] ?? 0,
                        'price_plus' => $item['price_plus'] ?? 0,
                        'selling_price' => $item['selling_price'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('quotations.index')->with('success', 'Quotation created successfully.');
    }

    public function edit($id)
    {
        $quotation = Quotation::with('items')->findOrFail($id);
        $clientOptions = Client::orderBy('name')->pluck('name', 'id')->toArray();
        $companyOptions = Company::orderBy('name')->pluck('name', 'id')->toArray();

        return view('pages.quotations.edit', compact('quotation', 'clientOptions', 'companyOptions'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate($this->rules);
        $data['modified_by'] = auth()->id();

        $items = $data['items'] ?? [];
        unset($data['items']);

        $quotation = Quotation::findOrFail($id);
        $quotation->update($data);

        // Delete existing items and recreate
        $quotation->items()->delete();

        // Save new quotation items
        if (!empty($items)) {
            foreach ($items as $item) {
                if (!empty($item['item'])) {
                    $quotation->items()->create([
                        'item' => $item['item'] ?? null,
                        'qty' => $item['qty'] ?? 0,
                        'satuan' => $item['satuan'] ?? 0,
                        'purchase_price' => $item['purchase_price'] ?? 0,
                        'total_price' => $item['total_price'] ?? 0,
                        'up_price' => $item['up_price'] ?? 0,
                        'price_plus' => $item['price_plus'] ?? 0,
                        'selling_price' => $item['selling_price'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('quotations.index')->with('success', 'Quotation updated successfully.');
    }

    public function destroy($id)
    {
        Quotation::findOrFail($id)->delete();

        return redirect()->route('quotations.index')->with('success', 'Quotation deleted successfully.');
    }

    public function downloadPdf($id)
    {
        $quotation = Quotation::with(['client', 'company', 'items', 'uploadedBy'])->findOrFail($id);

        return PdfService::download(
            'pdf.quotation',
            ['quotation' => $quotation],
            "Quotation-{$quotation->number}.pdf"
        );
    }

    public function previewPdf($id)
    {
        $quotation = Quotation::with(['client', 'company', 'items', 'uploadedBy'])->findOrFail($id);

        return PdfService::stream(
            'pdf.quotation',
            ['quotation' => $quotation]
        );
    }
}
