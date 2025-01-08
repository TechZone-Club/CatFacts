<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatFactController;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Trang chính (form nhập số lượng sự thật về mèo)
Route::get('/', function () {
    return view('cat');
});

// Route hiển thị form nhập số lượng sự thật về mèo
Route::get('/cat', [CatFactController::class, 'showCatForm'])->name('cat.form');

// Route lấy dữ liệu về mèo và tạo PDF
Route::post('/cat-facts', [CatFactController::class, 'getCatFacts'])->name('cat.facts');

// Route hiển thị danh sách các file PDF đã tạo
Route::get('/pdf-list', [CatFactController::class, 'listPdfFiles'])->name('cat.list_pdfs');

// Route xóa file PDF
Route::delete('/delete-pdf/{file}', [CatFactController::class, 'deletePdf'])->name('cat.delete_pdf');


