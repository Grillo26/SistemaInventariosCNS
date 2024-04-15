<?php

namespace App\Http\Livewire;
use App\Models\Grupo;
use App\Models\Cuenta;
use App\Models\Unidad;
use App\Models\Pasillo;
use App\Models\Mesa;
use App\Models\Estante;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Producto;
use App\Models\Entrada;

use Carbon\Carbon;
use Livewire\Component;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;

class Reporte extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    public function render()
    {
        return view('livewire.reporte');
    }

    public function vencimiento()
    {
        return view('pages.reporte.reporte-data',);
    }

    public function stock()
    {
        return view('pages.reporte.reporte-stock');
    }

    public function sinsalida(){
        return view('pages.reporte.reporte-sinsalida');
    }

    public function almacen(){
        return view('pages.reporte.reporte-almacen');
    }

    public function entradas(){
        return view('pages.reporte.reporte-entradas');
    }

    public function salidas(){
        return view('pages.reporte.reporte-salidas');
    }

    public function proveedores(){
        return view('pages.reporte.reporte-proveedores');
    }

    public function solicitudes(){
        return view('pages.reporte.reporte-solicitudes');
    }

    public function articulopdf(){ //Reporte de los articulos en pdf
        $pasillos = Pasillo::orderBy('id', 'asc')->get();   
        $estantes = Estante::orderBy('id', 'asc')->get();   
        $mesas = Mesa::orderBy('id', 'asc')->get(); 
        $grupos = Grupo::orderBy('id', 'asc')->get();   
        $cuentas = Cuenta::orderBy('id', 'asc')->get();   
        $unidades = Unidad::orderBy('id', 'asc')->get();   
        $categorias = Categoria::orderBy('id', 'asc')->get();   
        $subcategorias = Subcategoria::orderBy('id', 'asc')->get();  

        // Obtener todos los productos
        $productos = Producto::all();
        $pdf = Pdf::loadView('pages.pdf.articulo', compact('productos','categorias','subcategorias','pasillos','estantes','mesas','grupos','cuentas','unidades'));
        return $pdf->setPaper('A4')->stream('productos.pdf');
    }

}
