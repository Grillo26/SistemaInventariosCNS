<?php

namespace App\Http\Livewire;
use App\Models\Inventario; 
use App\Models\Producto; 


use Livewire\Component;

class Kardex extends Component
{
    public $productoId;
    public $kardex;
    public $nombre_producto=" ";

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
        $producto = Producto::find($this->productoId);
        $this->nombre_producto = Producto::find($this->productoId)->nombre_producto;
        
        if ($producto) {
            $this->kardex = Inventario::where('producto_id', $this->productoId)
                ->orderBy('created_at')
                ->get();
        }
    }

    public function updatedProductoId()
    {
        if ($this->productoId) {
            $this->mostrarKardex();
        }
    }
}
