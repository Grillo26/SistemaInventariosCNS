<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Inventario;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

class ReporteAlmacen extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];

    public function mount(){
        // Productos sin registro en la tabla 'inventario'
        $productosSinInventario = Producto::whereNotIn('id', Inventario::pluck('producto_id'))->get();

        // Productos con registro en la tabla 'inventario' pero con stock cero
        $productosConStockCero = Inventario::select('producto_id')
            ->selectRaw('SUM(cantidad_entrada) - SUM(cantidad_salida) as stock')
            ->groupBy('producto_id')
            ->havingRaw('stock = 0')
            ->get();

        // Crear una matriz de productos y sus detalles
        $this->productos = [];
        foreach ($productosSinInventario as $producto) {
            $this->productos[] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre_producto,
                'stock' => 0, // No hay stock porque no hay registro en inventario
            ];
        }
        foreach ($productosConStockCero as $producto) {
            $this->productos[] = [
                'id' => $producto->producto_id,
                'nombre' => Producto::find($producto->producto_id)->nombre_producto,
                'stock' => 0, // Stock cero
            ];
        }
    }

    public function render()
    {
        
        return view('livewire.reporte-almacen');
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
