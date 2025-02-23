<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePdf()
    {
        // Data to pass to the view (optional)
        $data = [
            'title' => 'Sample PDF',
            'content' => 'This is a sample PDF generated using DomPDF in Laravel.',
        ];

        // Load the view and generate the PDF
        $pdf = Pdf::loadView('pdf-template', $data);

        // Download the PDF
        return $pdf->download('document.pdf');
    }
    public function generateCurrentPagePdf(Request $request)
    {
        // Current page ka HTML content request se lekar
        $html = $request->input('html');

        // PDF generate karein
        $pdf = Pdf::loadHTML($html);

        // PDF download karein
        return $pdf->download('current-page.pdf');
    }
}
