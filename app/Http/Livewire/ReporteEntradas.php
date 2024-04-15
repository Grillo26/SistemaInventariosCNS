<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Inventario;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteEntradas extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    
    public $fechaInicio;
    public $fechaFin;
    public $entradas, $fechaRango;


    public function mount(){
        $this->entradas = null;
        $this->productos = Producto::all();
        $this->fechaInicio = Carbon::today()->subWeek(); // Establece la fecha de inicio por defecto
        $this->fechaFin = Carbon::today();
        $this->filtrarEntradas();
       
    }
    public function filtrarEntradas()
    {
        // Filtra las salidas del almacén según el rango de fechas seleccionado
        $this->entradas = Entrada::whereBetween('fecha_adquisicion', [$this->fechaInicio, $this->fechaFin])->get();
    }

    public function render()
    {
        
        return view('livewire.reporte-entradas');
    }

    public function order($sort){ //Metodo para ordenar
        if ($this->sort == $sort) {
            if($this->direction == 'desc'){
                $this->direction ='asc';
            }
            else{
                $this->direction = 'desc';
            }
        }
        else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function pdf(Request $request, $fechaInicio, $fechaFin){
        $productos = Producto::all();
        $entradas = Entrada::whereBetween('fecha_adquisicion', [$fechaInicio, $fechaFin])->get();
        // Filtra las entradas del almacén según el rango de fechas seleccionado
        $pdf = Pdf::loadView('pages.pdf.entradas', compact('entradas','productos'));
        return $pdf->setPaper('A4')->stream('entradas.pdf');

    }

}
