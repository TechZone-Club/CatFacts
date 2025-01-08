<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatFactsController;

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
    return view('welcome');
});


Route::get('/catfact', [CatFactsController::class, 'showForm'])->name('catfact.form');
Route::post('/catfact/generate', [CatFactsController::class, 'generatePdf'])->name('catfact.generate');
Route::get('/catfact/list', [CatFactsController::class, 'listPdf'])->name('catfact.list');
Route::get('/catfact/download/{filename}', [CatFactsController::class, 'downloadPdf'])->name('catfact.download');
Route::delete('/catfact/delete/{filename}', [CatFactsController::class, 'deletePdf'])->name('catfact.delete');
Route::get('/pdfs', [CatFactsController::class, 'listPDFs'])->name('list-pdfs');
Route::delete('/pdfs/{fileName}', [CatFactsController::class, 'deletePDF'])->name('delete-pdf');
Route::post('/generate-pdf', [CatFactsController::class, 'generatePDF'])->name('generate-pdf');
Route::get('/', function () {
    return view('index');
});





