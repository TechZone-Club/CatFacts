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


Route::get('/catfact', [CatFactController::class, 'showForm'])->name('catfact.form');
Route::post('/catfact/generate', [CatFactController::class, 'generatePdf'])->name('catfact.generate');
Route::get('/catfact/list', [CatFactController::class, 'listPdf'])->name('catfact.list');
Route::get('/catfact/download/{filename}', [CatFactController::class, 'downloadPdf'])->name('catfact.download');
Route::delete('/catfact/delete/{filename}', [CatFactController::class, 'deletePdf'])->name('catfact.delete');

