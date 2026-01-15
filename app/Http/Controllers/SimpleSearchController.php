<?php

namespace App\Http\Controllers;

use App\Models\SimpleSearch;
use App\Models\Client;
use App\Models\Company;
use App\Services\PdfService;
use Illuminate\Http\Request;

class SimpleSearchController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->applyResourcePermissions();
        $this->pdfService = $pdfService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return SimpleSearch::datatable();
        }

        return view('pages.simple-searches.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::pluck('name', 'id')->toArray();
        $statusOptions = ['Draft', 'Pembayaran', 'Selesai', 'Batal'];

        return view('pages.simple-searches.create', compact('clients', 'statusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'pekerjaan' => 'required|string',
            'client' => 'required|string|max:100',
            'nilai' => 'required|numeric|min:0',
            'status' => 'required|string|in:Draft,Pembayaran,Selesai,Batal',
        ]);

        SimpleSearch::create($validated);

        return redirect()->route('simple-searches.index')->with('success', 'Data Simple Search berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $simpleSearch = SimpleSearch::findOrFail($id);
        $clients = Client::pluck('name', 'id')->toArray();
        $statusOptions = ['Draft', 'Pembayaran', 'Selesai', 'Batal'];

        return view('pages.simple-searches.edit', compact('simpleSearch', 'clients', 'statusOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'pekerjaan' => 'required|string',
            'client' => 'required|string|max:100',
            'nilai' => 'required|numeric|min:0',
            'status' => 'required|string|in:Draft,Pembayaran,Selesai,Batal',
        ]);

        $simpleSearch = SimpleSearch::findOrFail($id);
        $simpleSearch->update($validated);

        return redirect()->route('simple-searches.index')->with('success', 'Data Simple Search berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $simpleSearch = SimpleSearch::findOrFail($id);
        $simpleSearch->delete();

        return redirect()->route('simple-searches.index')->with('success', 'Data Simple Search berhasil dihapus.');
    }

    /**
     * Preview PDF for a single Simple Search
     */
    public function previewPdf($id)
    {
        $item = SimpleSearch::findOrFail($id);
        $company = Company::with('bank')->first();
        $items = [$item];

        $letterDate = now()->locale('id_ID')->isoFormat('D MMMM YYYY');
        $amountNumber = 'Rp ' . number_format($item->nilai ?? 0, 0, ',', '.');
        $amountWords = $this->numberToWords($item->nilai ?? 0);
        $logoPath = public_path('icons/logo.png');

        return view('pdf.simple-search', compact('item', 'items', 'company', 'letterDate', 'amountNumber', 'amountWords', 'logoPath'));
    }

    /**
     * Download PDF for a single Simple Search
     */
    public function downloadPdf($id)
    {
        $item = SimpleSearch::findOrFail($id);
        $company = Company::with('bank')->first();
        $items = [$item];

        $letterDate = now()->locale('id_ID')->isoFormat('D MMMM YYYY');
        $amountNumber = 'Rp ' . number_format($item->nilai ?? 0, 0, ',', '.');
        $amountWords = $this->numberToWords($item->nilai ?? 0);
        $logoPath = public_path('icons/logo.png');

        $html = view('pdf.simple-search', compact('item', 'items', 'company', 'letterDate', 'amountNumber', 'amountWords', 'logoPath'))->render();

        return $this->pdfService->download(
            $html,
            'Simple-Search-' . $item->id . '.pdf'
        );
    }

    /**
     * Export all Simple Searches to PDF with filter
     */
    public function exportPdf(Request $request)
    {
        $query = SimpleSearch::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('pekerjaan', 'like', "%{$search}%")
                ->orWhere('client', 'like', "%{$search}%");
        }

        $items = $query->get();
        $company = Company::with('bank')->first();

        $letterDate = now()->locale('id_ID')->isoFormat('D MMMM YYYY');
        $totalNilai = $items->sum('nilai');
        $amountNumber = 'Rp ' . number_format($totalNilai ?? 0, 0, ',', '.');
        $amountWords = $this->numberToWords($totalNilai ?? 0);
        $item = $items->first();
        $logoPath = public_path('icons/logo.png');

        $html = view('pdf.simple-search', compact('item', 'items', 'company', 'letterDate', 'amountNumber', 'amountWords', 'logoPath'))->render();

        return $this->pdfService->download(
            $html,
            'Simple-Search-' . date('Y-m-d-His') . '.pdf'
        );
    }

    /**
     * Convert number to Indonesian words
     */
    protected function numberToWords($number)
    {
        $number = intval($number);

        if ($number == 0) {
            return 'Nol Rupiah';
        }

        $words = [
            1 => 'Satu',
            2 => 'Dua',
            3 => 'Tiga',
            4 => 'Empat',
            5 => 'Lima',
            6 => 'Enam',
            7 => 'Tujuh',
            8 => 'Delapan',
            9 => 'Sembilan',
            10 => 'Sepuluh',
            11 => 'Sebelas',
        ];

        $scales = [
            1000000000 => 'Miliar',
            1000000 => 'Juta',
            1000 => 'Ribu',
            1 => '',
        ];

        $result = '';

        foreach ($scales as $scale => $scaleName) {
            if ($number >= $scale) {
                $count = intval($number / $scale);

                if ($scale >= 1000 && $count == 1) {
                    $result .= 'Se' . $scaleName . ' ';
                } else {
                    $result .= $this->convertBelow1000($count, $words) . ' ' . $scaleName . ' ';
                }

                $number %= $scale;
            }
        }

        return trim($result) . ' Rupiah';
    }

    /**
     * Helper to convert numbers below 1000
     */
    protected function convertBelow1000($num, $words)
    {
        if ($num == 0) {
            return '';
        }

        if ($num < 12) {
            return $words[$num] ?? '';
        }

        if ($num < 20) {
            return $words[$num - 10] . ' Belas';
        }

        $tens = intval($num / 10) * 10;
        $units = $num % 10;

        $tWords = [
            20 => 'Dua Puluh',
            30 => 'Tiga Puluh',
            40 => 'Empat Puluh',
            50 => 'Lima Puluh',
            60 => 'Enam Puluh',
            70 => 'Tujuh Puluh',
            80 => 'Delapan Puluh',
            90 => 'Sembilan Puluh',
        ];

        $result = $tWords[$tens] ?? '';

        if ($units > 0) {
            $result .= ' ' . $words[$units];
        }

        return trim($result);
    }
}
