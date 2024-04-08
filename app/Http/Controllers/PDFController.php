<?php

namespace App\Http\Controllers;

use App\Models\CompraProducto;
use App\Models\Producto;
use App\Models\Salida;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    
    public function generarPDFfechaEntrada(Request $request)
    {
        $articulos =  Producto::all();
        $usuarios = User::all();
        

        if ($request->has('fecha_ingreso')) {
            $fechas = explode(' to ', $request->input('fecha_ingreso'));
            $inicio = date('Y-m-d', strtotime($fechas[0]));
            $fin = date('Y-m-d', strtotime($fechas[1]));

            $registros = CompraProducto::whereBetween('fecha_adquisicion', [$inicio, $fin])->get();
            $pdf = PDF::loadView('view_pdf.entrada_rango_fecha', compact('registros', 'usuarios', 'articulos'));

            return $pdf->download('entrada_rango_fecha.pdf');
        }
    }

    public function generarPDFfechaSalida(Request $request)
    {
        $articulos =  Producto::all();
        $usuarios = User::all();
        

        if ($request->has('fecha_ingreso')) {
            $fechas = explode(' to ', $request->input('fecha_ingreso'));
            $inicio = date('Y-m-d', strtotime($fechas[0]));
            $fin = date('Y-m-d', strtotime($fechas[1]));

            $registros = Salida::whereBetween('fecha_salida', [$inicio, $fin])->get();
            $pdf = PDF::loadView('view_pdf.salida_rango_fecha', compact('registros', 'usuarios', 'articulos'));

            return $pdf->download('salida_rango_fecha.pdf');
        }
    }
}
