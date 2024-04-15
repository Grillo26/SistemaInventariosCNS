<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Inventario;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class ReporteSalidas extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];
    
    public $fechaInicio;
    public $fechaFin;
    public $entradas, $fechaRango;

    public function mount(){
        $this->productos = Producto::all();
        $this->fechaInicio = Carbon::today()->subWeek(); // Establece la fecha de inicio por defecto
        $this->fechaFin = Carbon::today();
        $this->filtrarSalidas();
       
    }
    public function filtrarSalidas()
    {
        // Filtra las salidas del almacén según el rango de fechas seleccionado
        $this->salidas = Salida::whereBetween('fecha_salida', [$this->fechaInicio, $this->fechaFin])->get();
    }


    public function render()
    {
        
        return view('livewire.reporte-salidas');
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
        $salidas = Salida::whereBetween('fecha_salida', [$fechaInicio, $fechaFin])->get();
        // Filtra las salidas del almacén según el rango de fechas seleccionado
        $pdf = Pdf::loadView('pages.pdf.salidas', compact('salidas','productos'));
        return $pdf->setPaper('A4')->stream('salidas.pdf');

    }

}
