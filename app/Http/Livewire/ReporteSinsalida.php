<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Inventario;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

class ReporteSinsalida extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';
    public $fechaInicio;
    public $fechaFin;
    public $salidas;

    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];

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
        $stock = Inventario::select('producto_id')
        ->selectRaw('SUM(cantidad_entrada) - SUM(cantidad_salida) as cantidad_actual')
        ->groupBy('producto_id')
        ->get();

        return view('livewire.reporte-sinsalida',  compact ('stock'));
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

}
