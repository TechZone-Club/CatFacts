<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;  // Thêm dòng này để sử dụng class File

class CatFactController extends Controller
{
    public function generatePdf(Request $request)
    {
        $count = $request->input('count', 1);
        $response = Http::get("https://catfact.ninja/facts?limit=$count");
        $facts = $response->json()['data'];

        $pdf = Pdf::loadView('pdf.catfacts', compact('facts'));

        // Tạo tên file duy nhất
        $fileName = 'cat_facts_' . time() . '.pdf';

        // Lưu file vào storage/app/public/pdf
        Storage::put("public/pdf/$fileName", $pdf->output());

        return redirect()->route('pdf.list')->with('success', 'PDF created successfully!');
    }

    public function listPdfs()
    {
        // Lấy danh sách file từ storage
        $files = Storage::files('public/pdf');

        // Lấy thông tin file
        $fileDetails = collect($files)->map(function ($file) {
            return [
                'name' => basename($file),
                'path' => Storage::url($file),
                'size' => Storage::size($file),
                'last_modified' => Storage::lastModified($file)
            ];
        })->sortByDesc('last_modified');

        return view('pdf.list', ['files' => $fileDetails]);
    }

    public function downloadPdf($fileName)
    {
        $filePath = "public/pdf/$fileName";

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }

        return abort(404, 'File not found');
    }

    public function deletePdf($fileName)
    {
        $filePath = "public/pdf/$fileName";
    
        if (Storage::exists($filePath)) {
            Storage::delete($filePath); // Xóa file bằng Storage
            return redirect()->route('pdf.list')->with('success', 'File PDF đã được xóa thành công.');
        }
    
        return redirect()->route('pdf.list')->with('error', 'File không tồn tại hoặc đã bị xóa.');
    }
}
