<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class CatFactsController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function generatePdf(Request $request)
    {
        $number = $request->input('number');

        // Fetch cat facts from API
        $facts = $this->fetchCatFacts($number);

        // Generate PDF content
        $pdf = Pdf::loadView('pdf.cat_facts', compact('facts'));

        // Save PDF to storage
        $filename = "cat_facts_{$number}_" . time() . ".pdf";
        Storage::put("public/pdfs/{$filename}", $pdf->output());

        return redirect()->route('pdf.list');
    }

    public function listPdf()
    {
        // Get list of stored PDF files
        $files = collect(Storage::files('public/pdfs'))
            ->map(function ($file) {
                return [
                    'name' => basename($file),
                    'size' => Storage::size($file),
                    'facts_count' => $this->getFactsCountFromFilename($file),
                    'path' => $file,
                ];
            })
            ->sortByDesc('facts_count');

        return view('pdf.list', compact('files'));
    }

    public function deletePdf($filename)
    {
        $path = "public/pdfs/{$filename}";
        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        return redirect()->route('pdf.list')->with('success', 'PDF deleted successfully.');
    }

    private function fetchCatFacts($number)
    {
        $response = Http::get("https://catfact.ninja/facts?limit={$number}");
        return $response->json()['data'] ?? [];
    }

    private function getFactsCountFromFilename($file)
    {
        preg_match('/cat_facts_(\d+)_/', basename($file), $matches);
        return $matches[1] ?? 0;
    }

    public function downloadPdf($filename)
{
    // Get the file path
    $path = storage_path("app/public/pdfs/{$filename}");

    // Check if the file exists before attempting to download it
    if (file_exists($path)) {
        return response()->download($path);
    }

    return redirect()->route('pdf.list')->with('error', 'File not found.');
}
}


