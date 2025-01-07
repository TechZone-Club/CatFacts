<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;

class CatFactController extends Controller
{
    public function generatePDF(Request $request)
    {
        $number = $request->input('number');

        // Gửi yêu cầu tới API CatFact Ninja
        $response = Http::get("https://catfact.ninja/facts?limit=$number");

        if ($response->failed()) {
            return back()->with('error', 'Failed to fetch cat facts');
        }

        $facts = $response->json()['data'];

        // Tạo nội dung file PDF
        $pdfContent = "<h1>Cat Facts</h1><ul>";
        foreach ($facts as $fact) {
            $pdfContent .= "<li>{$fact['fact']}</li>";
        }
        $pdfContent .= "</ul>";

        // Sử dụng Dompdf để tạo PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($pdfContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Lưu file PDF
        $fileName = 'cat_facts_' . time() . '.pdf';
        $filePath = storage_path("app/public/$fileName");
        file_put_contents($filePath, $dompdf->output());

        // Lấy danh sách file PDF hiện có trong thư mục public
       

        // Trả về view với danh sách file PDF
        return redirect()->route('catfacts');
    }
    public function deletePDF($file)
{
    $filePath = 'public/' . $file; // Đường dẫn tới file

    if (\Storage::exists($filePath)) { // Kiểm tra nếu file tồn tại
        \Storage::delete($filePath); // Xóa file
        return back()->with('success', 'File deleted successfully!');
    }

    return back()->with('error', 'File not found!');
}
public function index(){
    $files = Storage::files('public');
    $pdfFiles = array_filter($files, function ($file) {
        return str_ends_with($file, '.pdf');
    });
    $pdfFiles = array_map(function ($file) {
        return basename($file);
    }, $pdfFiles);
    return view('catfacts', ["pdfFiles"=>$pdfFiles]);
}
}


