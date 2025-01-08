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
            return redirect()->back()->with('error', 'No cat facts found');
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

        // Chuyển hướng đến danh sách file PDF
        return redirect()->route('cat.list_pdfs')->with('message', 'PDF created successfully');
    }

    // Hiển thị danh sách các file PDF và hỗ trợ tìm kiếm
    public function listPdfFiles(Request $request)
    {
        $search = $request->query('search', ''); // Lấy từ khóa tìm kiếm từ query string
        $pdfPath = public_path('pdfs');

        // Lấy danh sách tất cả các file
        $allFiles = scandir($pdfPath);

        // Lọc chỉ các file PDF và theo từ khóa tìm kiếm
        $pdfFiles = array_filter($allFiles, function ($file) use ($search) {
            return str_contains(strtolower($file), strtolower($search)) && pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
        });

        // Sắp xếp danh sách file PDF theo thứ tự mới nhất trước
        usort($pdfFiles, function ($a, $b) use ($pdfPath) {
            return filemtime($pdfPath . '/' . $b) - filemtime($pdfPath . '/' . $a);
        });

        return view('pdf_list', ['pdfFiles' => $pdfFiles, 'search' => $search]);
    }

    // Xóa file PDF
    public function deletePdf($file)
{
    // Đường dẫn đầy đủ đến file PDF
    $filePath = public_path('pdfs/' . $file);

    // Kiểm tra nếu file tồn tại
    if (File::exists($filePath)) {
        // Xóa file
        File::delete($filePath);

        // Chuyển hướng với thông báo thành công
        return redirect()->route('cat.list_pdfs')->with('message', 'PDF deleted successfully');
    }

    // Nếu file không tồn tại, chuyển hướng với thông báo lỗi
    return redirect()->route('cat.list_pdfs')->with('error', 'File not found');
}

}
