<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Proveedor;
use Carbon\Carbon;
use Livewire\Component;

class ReporteProveedores extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];
    
    public function mount(){
        $this->productos = Producto::all();
        $this->proveedores = Proveedor::all();
       
    }

    public function render()
    {
        
        return view('livewire.reporte-proveedores');
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
