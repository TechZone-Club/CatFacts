<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\File; // Để sử dụng File facade

class CatFactController extends Controller
{
    // Hiển thị form nhập số lượng sự thật về mèo
    public function showCatForm()
    {
        return view('cat');
    }

    // Lấy sự thật về mèo từ API và tạo file PDF
    public function getCatFacts(Request $request)
    {
        // Lấy số lượng sự thật về mèo từ form
        $numFacts = $request->input('num_facts', 1);

        // Gọi API để lấy dữ liệu về mèo
        $response = file_get_contents("https://catfact.ninja/facts?limit=$numFacts");
        $data = json_decode($response, true);

        // Kiểm tra xem có sự thật về mèo không
        if (!isset($data['data']) || empty($data['data'])) {
            return response()->json(['message' => 'No cat facts found'], 404);
        }

        // Tạo HTML từ dữ liệu sự thật về mèo
        $html = "<h1>Cat Facts</h1>";
        foreach ($data['data'] as $fact) {
            $html .= "<p>" . $fact['fact'] . "</p>";
        }

        // Tạo PDF từ HTML
        $pdf = PDF::loadHTML($html);

        // Tạo tên file PDF
        $fileName = 'cat_facts_' . time() . '.pdf';

        // Đường dẫn lưu file PDF
        $path = public_path('pdfs/' . $fileName);

        // Lưu file PDF vào thư mục public
        $pdf->save($path);

        // Trả về URL để tải file PDF
        return redirect()->route('cat.list_pdfs')->with('message', 'PDF created successfully');
    }

    // Hiển thị danh sách các file PDF đã tạo
    public function listPdfFiles()
    {
        // Lấy danh sách các file PDF từ thư mục public/pdfs
        $files = scandir(public_path('pdfs'));

        // Lọc ra chỉ các file PDF
        $pdfFiles = array_filter($files, function ($file) {
            return strpos($file, '.pdf') !== false;
        });

        // Sắp xếp danh sách file PDF theo thứ tự giảm dần (mới nhất trước)
        usort($pdfFiles, function ($a, $b) {
            return filemtime(public_path('pdfs/' . $b)) - filemtime(public_path('pdfs/' . $a));
        });

        return view('pdf_list', ['pdfFiles' => $pdfFiles]);
    }

    // Xóa file PDF
    public function deletePdf($file)
    {
        $filePath = public_path('pdfs/' . $file);

        // Kiểm tra nếu file tồn tại
        if (File::exists($filePath)) {
            // Xóa file
            File::delete($filePath);

            return redirect()->route('cat.list_pdfs')->with('message', 'PDF deleted successfully');
        }

        return redirect()->route('cat.list_pdfs')->with('error', 'File not found');
    }
}
