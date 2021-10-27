<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Usuario;

class PDFController extends Controller
{
    public function PDF(){
        $usuarios = Usuario::all();
        $pdf = PDF::loadView('comprobante', compact('usuarios'));
        //return $pdf->download('detalle-compra.pdf'); //Descarga el documento PDF
        return $pdf->stream('detalle-compra.pdf'); //Previsualiza el documento PDF
        
    }
}
