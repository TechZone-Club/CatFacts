<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatFactController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome'); // Trang chính để nhập số lượng sự thật về mèo
});



Route::get('/pdf/list', [CatFactController::class, 'listPdfs'])->name('pdf.list');
Route::post('/pdf/generate', [CatFactController::class, 'generatePdf'])->name('pdf.generate');
Route::get('/pdf/download/{fileName}', [CatFactController::class, 'downloadPdf'])->name('pdf.download');
Route::delete('/pdf/delete/{fileName}', [CatFactController::class, 'deletePdf'])->name('pdf.delete');