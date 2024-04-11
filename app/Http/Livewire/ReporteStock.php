<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Inventario;
use App\Models\Proveedor;
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
        $this->proveedores = Proveedor::all();
        
    }

    public function render()
    {
        $this->stock = Inventario::select('producto_id', 'proveedor_idProveedor')
            ->orwhere('producto_id', 'like', '%' . $this->search . '%')  
            ->orwhere('proveedor_idProveedor', 'like', '%' . $this->search . '%')  
            ->selectRaw('SUM(cantidad_entrada) - SUM(cantidad_salida) as cantidad')
            ->groupBy('producto_id', 'proveedor_idProveedor')
            ->orderBy($this->sort, $this->direction)
            ->get();
        return view('livewire.reporte-stock');
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
