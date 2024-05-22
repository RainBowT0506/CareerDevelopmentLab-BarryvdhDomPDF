<?php

use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

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


Route::get('generate-pdf', [PdfController::class, 'generatePdf'])->name('generate-pdf');

Route::get('download-pdf', [PdfController::class, 'downloadPdf'])->name('download-pdf');

Route::get('download-view-pdf', [PdfController::class, 'downloadViewPdf'])->name('download-view-pdf');

Route::get('download-image-pdf', [PdfController::class, 'donwloadImagePdf'])->name('download-image-pdf');

Route::get('storage-pdf', [PdfController::class, 'storagePdf'])->name('storage-pdf');

Route::get('show-pdf', [PdfController::class, 'showPdf'])->name('show-pdf');
