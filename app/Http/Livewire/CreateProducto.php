<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use App\Models\Grupo;
use App\Models\Cuenta;
use App\Models\Unidad;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
class CreateProducto extends Component
{
    public $producto;
    public $productoId;
    public $action;
    public $button;
    public $idGrupo; //Conecta el id del select con el front
    public $idCuenta; //Conecta el id del select con el front
    public $idUnidad; //Conecta el id del select con el front
    public $grupos, $cuentas, $unidades;
    protected function getRules()
    {
        $rules = ($this->action == "updateProducto" . $this->productoId) ? [
            'producto.nombre_producto' => 'required',
        ] : [
            'producto.nombre_producto' => 'required|min:8|confirmed',
            'producto.codigo_producto' => 'required|min:8|confirmed',
            'producto.unidad_idUnidad' => 'required|min:8|confirmed',
            'producto.grupo_idGrupo' => 'required|min:8|confirmed',
            'producto.cuenta_idCuenta' => 'required|min:8|confirmed',
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
        $data = $this->producto;
        $data['unidad_idUnidad'] = $this-> idUnidad;
        $data['grupo_idGrupo'] = $this-> idGrupo;
        $data['cuenta_idCuenta'] = $this-> idCuenta;
        Producto::create($data);

        $this->emit('saved');
        $this->reset('producto');
    }

    public function updateProducto()
    {
        if ($this->idUnidad !== null) {
            Producto::query()
            ->where('id', $this->productoId)
            ->update([
                "unidad_idUnidad" => $this-> idUnidad
            ]);
        }
        if ($this->idGrupo !== null) {
            Producto::query()
            ->where('id', $this->productoId)
            ->update([
                "grupo_idGrupo" => $this->idGrupo,
            ]);
        }
        
        if ($this->idCuenta !== null) {
            Producto::query()
            ->where('id', $this->productoId)
            ->update([
                "cuenta_idCuenta" => $this->idCuenta,
            ]);
        }
        
        Producto::query()
            ->where('id', $this->productoId)
            ->update([
                "codigo_producto" => $this->producto->codigo_producto,
                "nombre_producto" => $this->producto->nombre_producto,
            ]);
        /*$this->producto->save([
            "unidad_idUnidad" => $this-> idUnidad,
            "cuenta_idCuenta" => $this->idCuenta,
            "grupo_idGrupo" => $this->idGrupo,
        ]);*/
        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->producto && $this->productoId) {
            $this->producto = Producto::find($this->productoId);
        }

        $this->button = create_button($this->action, "Producto");
        $this->grupos = [];
    }

    public function render()
    {
        $this->grupos = Grupo::orderBy('id', 'asc')->get();   
        $this->cuentas = Cuenta::orderBy('id', 'asc')->get();   
        $this->unidades = Unidad::orderBy('id', 'asc')->get();   
        return view('livewire.create-producto');
    }
}
