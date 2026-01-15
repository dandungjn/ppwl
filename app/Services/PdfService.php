<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfService
{
    /**
     * Generate dan download PDF dari view dan data
     *
     * @param string $view
     * @param array $data
     * @param string|null $filename
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public static function download(string $view, array $data = [], string $filename = null)
    {
        $filename ??= 'document.pdf';

        $pdf = Pdf::loadView($view, $data);

        return $pdf->download($filename);
    }

    /**
     * Generate PDF dan stream ke browser (preview)
     */
    public static function stream(string $view, array $data = [])
    {
        $pdf = Pdf::loadView($view, $data);
        return $pdf->stream();
    }
}
