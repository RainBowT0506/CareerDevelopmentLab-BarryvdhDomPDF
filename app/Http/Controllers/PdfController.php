<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    public function generatePdf(){
        $pdf = App::make('dompdf.wrapper');
        //  通過修改 HTML 內容，可以在生成的 PDF 中包含不同的元素，例如 `<h1>`、 `<p>`標籤和段落。
        $pdf->loadHTML('<p>Generate Simple pdf file</p>');
        return $pdf->stream();
    }

    public function downloadPdf(){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Generate Simple pdf file</h1>');
        return $pdf->download();
    }

    public function downloadViewPdf(){
        $pdf = Pdf::loadView('index');
        return $pdf->download();
    }
}
