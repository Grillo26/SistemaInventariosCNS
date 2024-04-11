<?php

namespace App\Http\Livewire;
use App\Models\Inventario; 
use App\Models\Producto; 
use App\Models\Proveedor; 


use Livewire\Component;

class Kardex extends Component
{
    public $productoId;
    public $kardex;
    public $nombre_producto=" ";
    public $proveedores;
    public $cantidad = 0;

    public function render()
    {
        $productos = Producto::all();
        return view('livewire.kardex', ['productos' => $productos]);
    }
    

    public function mount()
    {
        // Inicializar el ID del producto seleccionado
        $this->productoId = null;
        $this->kardex = [];
    }

    public function mostrarKardex()
    {
        $this->proveedores = Proveedor::orderBy('id', 'asc')->get();   
        $producto = Producto::find($this->productoId);
        $this->nombre_producto = Producto::find($this->productoId)->nombre_producto;
        
        if ($producto) {
            $this->kardex = Inventario::where('producto_id', $this->productoId)
                ->orderBy('created_at')
                ->get();
                $this->cantidad = Inventario::where('producto_id', $this->productoId)
                ->sum('cantidad_entrada') - Inventario::where('producto_id', $this->productoId)
                ->sum('cantidad_salida');
        }
    }

    public function updatedProductoId()
    {
        if ($this->productoId) {
            $this->mostrarKardex();
        }
    }
}
