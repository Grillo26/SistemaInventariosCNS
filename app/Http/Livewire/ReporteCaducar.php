<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

class ReporteCaducar extends Component
{

    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    public function mount(){
        $this->productos = Producto::all();
    }

    public function render()
    {
       // Obtener artículos próximos a caducar
       $articulosCaducar = Entrada::whereDate('fecha_caducidad', '<', Carbon::now())
        ->orWhereHas('productos', function($query) { 
            $query->where('codigo_producto', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('productos', function($query) {
            $query->where('nombre_producto', 'like', '%' . $this->search . '%');
        })   
        ->orderBy('fecha_caducidad') // Eliminado el uso de '%'
        ->get();

    return view('livewire.reporte-caducar', ['articulosCaducar' => $articulosCaducar]);

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
 