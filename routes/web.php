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
    return view('welcome');
});



Route::get('/', function () {
    return view('catfacts');
});

Route::post('/generate-pdf', [CatFactController::class, 'generatePDF'])->name('generate.pdf');
Route::get('/pdfs', [CatFactController::class, 'listPDFs'])->name('list.pdfs');
Route::delete('/pdfs/{file}', [CatFactController::class, 'deletePDF'])->name('delete.pdf');

