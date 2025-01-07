<?php

use App\Http\Controllers\CatFactsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CatFactsController::class, 'index'])->name('home');
Route::post('/generate-pdf', [CatFactsController::class, 'generatePdf'])->name('generate.pdf');
Route::get('/pdf/list', [CatFactsController::class, 'listPdf'])->name('pdf.list');
Route::get('/pdf/download/{filename}', [CatFactsController::class, 'downloadPdf'])->name('download.pdf');
Route::delete('/pdf/delete/{filename}', [CatFactsController::class, 'deletePdf'])->name('pdf.delete');



