<?php

namespace App\Http\Livewire;
use App\Models\CompraProducto;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

class ReporteStock extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];

    public function mount(){
        $this->productos = Producto::all();
    }

    public function render()
    {
        $entradas = CompraProducto::where('producto_idProducto', 'like', '%' . $this->search . '%')

        ->orWhereHas('productos', function($query) { //Realiza la búsqueda con la llave foránea en otra tabla
            $query->where('codigo_producto', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('productos', function($query) {
            $query->where('nombre_producto', 'like', '%' . $this->search . '%');
        })
        ->orwhere('cantidad_db', 'like', '%' . $this->search . '%')
        ->orwhere('fecha_adquisicion', 'like', '%' . $this->search . '%')   
        ->orwhere('fecha_caducidad', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->get();

        return view('livewire.reporte-stock',  compact ('entradas'));
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
