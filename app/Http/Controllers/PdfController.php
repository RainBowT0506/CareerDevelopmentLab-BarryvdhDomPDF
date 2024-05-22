<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $pdf = App::make('dompdf.wrapper');
        //  通過修改 HTML 內容，可以在生成的 PDF 中包含不同的元素，例如 `<h1>`、 `<p>`標籤和段落。
        $pdf->loadHTML('<p>Generate Simple pdf file</p>');
        return $pdf->stream();
    }

    public function downloadPdf()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Generate Simple pdf file</h1>');
        return $pdf->download();
    }

    public function downloadViewPdf()
    {
        $pdf = Pdf::loadView('index');
        return $pdf->download();
    }

    public function donwloadImagePdf(){
        $pdf = PDF::loadView('image');
        return $pdf->download('image.pdf');
    }

    public function storagePdf()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf = Pdf::loadView('index');
        $now_time = time();
        $pdf_filename = 'pick_up_note_' . $now_time . '.pdf';
        $now_path = 'deliveryNote/' . date("Ymd", time()) . '/';
        $file_path = $now_path . $pdf_filename;
        Log::info($file_path);
        //  存到 /storage/app/public/deliveryNote/
        Storage::disk('public')->put($file_path, $pdf->output());

        $file_full_path = storage_path('app/public/' . $file_path);
        if (File::exists($file_full_path)) {
            Log::info($pdf_filename . " is exist!");
            return Storage::disk('public')->download($file_path);
        }
    }

    public function showPdf()
    {
        $filePath = 'public/deliveryNote/20240417/pick_up_note_1713352435.pdf';

        if (!Storage::exists($filePath)) {
            abort(404, 'PDF file not found');
        }

        $file = Storage::path($filePath);
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="pick_up_note_1713352435.pdf"',
        ];

        return response()->file($file, $headers);
    }
}
