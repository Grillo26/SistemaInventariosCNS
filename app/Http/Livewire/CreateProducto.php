<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use App\Models\Grupo;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateProducto extends Component
{
    public $producto;
    public $productoId;
    public $action;
    public $button;
    public $idGrupo="q"; //Conecta el id del select con el front
    public $grupos;

    protected function getRules()
    {
        $rules = ($this->action == "updateProducto" . $this->productoId) ? [
            'producto.nombre_producto' => 'required',
        ] : [
            'producto.nombre_grupo' => 'required|min:8|confirmed',
            'producto.codigo_producto' => 'required|min:8|confirmed',
            'producto.unidad_idUnidad' => 'required',
            'producto.grupo_idGrupo' => 'required',
            'producto.cuenta_idCuenta' => 'required'
        ];

        return array_merge([
            'user.nombre_producto' => 'required|min:3',
            'user.codigo_producto' => 'required|min:3',
            'user.unidad_idUnidad' => 'required|min:3',
            'user.grupo_idGrupo' => 'required|min:3',
            'user.cuenta_idCuenta' => 'required|email|unique:users,email'
        ], $rules);
    }

    public function createProducto ()
    {
        
        Producto::create($this->producto);

        $this->emit('saved');
        $this->reset('producto');
    }

    public function updateProducto ()
    {
        
        Producto::query()
            ->where('id', $this->productoId)
            ->update([
                "codigo_producto" => $this->producto->codigo_producto,
                "nombre_producto" => $this->producto->nombre_producto,
                "unidad_idUnidad" => $this->producto->unidad_idUnidad,
                "cuenta_idCuenta" => $this->producto->cuenta_idCuenta,
            ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->producto && $this->productoId) {
            $this->producto = Producto::find($this->productoId);
        }

        $this->button = create_button($this->action, "grupos");
        $this->grupos = [];
    }

    public function render()
    {
        $this->grupos = Grupo::orderBy('id', 'asc')->get();   
        return view('livewire.create-producto');
    }
}
