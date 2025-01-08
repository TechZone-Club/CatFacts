<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


class CatFactsController extends Controller
{
    public function showForm()
    {
        return view('catfact-form');
    }

    public function generatePDF(Request $request)
    {
        $factsCount = $request->input('facts_count');
        $response = Http::get("https://catfact.ninja/facts", ['limit' => $factsCount]);
        $facts = $response->json()['data'];

        $pdf = Pdf::loadView('pdf.cat_facts', compact('facts'));
        $fileName = 'cat_facts_' . time() . '.pdf';
        $path = storage_path("app/public/{$fileName}");
       

        $pdf->save($path);
         $pdf->save(storage_path("app/public/{$fileName}"));
         
        return response()->download($path, $fileName);
        
    }
    public function listPdf()
    {
    $files = array_reverse(glob(storage_path('app/public/*.pdf')));
    $pdfFiles = array_map(function ($file) {
        return basename($file);
    }, $files);
    return view('pdf.list', compact('pdfFiles'));
    }

    public function downloadPdf($filename)
    {
        return response()->download(storage_path('app/public/pdfs/' . $filename));
    }

    public function deletePdf($filename)
    {
        $filePath = storage_path('app/public/pdfs/' . $filename);

        if (file_exists($filePath)) {
            unlink($filePath);
            return redirect()->route('catfact.list')->with('success', 'File đã được xóa thành công!');
        }

        return redirect()->route('catfact.list')->with('error', 'File không tồn tại!');
    }
}
    
