<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Storage;

class CatFactController extends Controller
{
    public function showForm()
    {
        return view('catfact-form');
    }

    public function generatePdf(Request $request)
    {
        $quantity = $request->input('quantity');
        if ($quantity <= 0) {
            return redirect()->back()->with('error', 'Số lượng phải lớn hơn 0');
        }

        $facts = [];
        $page = 1;

        while (count($facts) < $quantity) {
            $response = Http::get("https://catfact.ninja/facts?page={$page}");
            $data = $response->json();

            $facts = array_merge($facts, $data['data']);

            if ($data['last_page'] === $page || count($facts) >= $quantity) {
                break;
            }

            $page++;
        }

        $facts = array_slice($facts, 0, $quantity);

        $pdfContent = "<h1>Facts about Cat</h1><ul>";
        foreach ($facts as $fact) {
            $pdfContent .= "<li>" . htmlspecialchars($fact['fact']) . "</li>";
        }
        $pdfContent .= "</ul>";

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($pdfContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdfOutput = $dompdf->output();
        $filename = 'cat_facts_' . time() . '.pdf';
        Storage::disk('public')->put('pdfs/' . $filename, $pdfOutput);

        return redirect()->route('catfact.list');
    }


    public function listPdf()
    {
        $pdfFiles = Storage::disk('public')->files('pdfs');
        
        return view('catfact-list', ['pdfFiles' => $pdfFiles]);
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
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;

class CatFactsController extends Controller
{
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
    public function listPDFs()
    {
    $files = array_reverse(glob(storage_path('app/public/*.pdf')));
    return view('pdf.list', compact('files'));
    }

}
    
