<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use App\Models\Grupo;
use App\Models\Cuenta;
use App\Models\Unidad;
use App\Models\Pasillo;
use App\Models\Mesa;
use App\Models\Estante;
use App\Models\Categoria;
use App\Models\Subcategoria;
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
    public $pasillo_idPasillo, $estante_idEstante, $mesa_idMesa;
    public $categorias, $subcategorias;
    public $categoria_select = null , $subcategoria_select = null;



    protected function getRules()
    {
        $rules = ($this->action == "updateProducto" . $this->productoId) ? [
            'producto.nombre_producto' => 'required',
        ] : [
            'producto.nombre_producto' => 'required|min:8|confirmed',
            'producto.codigo_producto' => 'required|min:8|confirmed',
            'producto.unidad_idUnidad' => 'required',
            'producto.grupo_idGrupo' => 'required',
            'producto.cuenta_idCuenta' => 'required',
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
        /*Validaciones
        $this->validate([
            'producto.nombre_producto' => 'required',
            'producto.codigo_producto' => 'required',
            'producto.unidad_idUnidad' => 'required',
            'producto.grupo_idGrupo' => 'required',
            'producto.cuenta_idCuenta' => 'required'
        ],[
            'producto.nombre_producto.required' => 'Debe llenar con nombre',
            'producto.codigo_producto.required' => 'Debe llenar con un código',
            'producto.unidad_idUnidad.required' => 'Seleccione Unidad',
            'producto.grupo_idGrupo.required' => 'Seleccione Grupo',
            'producto.cuenta_idCuenta.required' => 'Seleccione Cuenta'        
        ]);*/

        $data = $this->producto;
        $data['unidad_idUnidad'] = $this-> idUnidad;
        $data['grupo_idGrupo'] = $this-> idGrupo;
        $data['cuenta_idCuenta'] = $this-> idCuenta;
        $data['pasillo_idPasillo'] = $this-> pasillo_idPasillo;
        $data['estante_idEstante'] = $this-> estante_idEstante;
        $data['mesa_idMesa'] = $this-> mesa_idMesa;
        $data['categoria_idCategoria'] = $this-> categoria_select;
        $data['subcategoria_idSubcategoria'] = $this-> subcategoria_select;
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

    public function updatedCategoriaSelect($value)
    {
        if (!empty($value)) {
            $this->subcategorias = Subcategoria::where('categoria_idCategoria', $value)->get();
        } else {
            $this->subcategorias = null;
        }
    }

    public function render()
    {
        $this->pasillos = Pasillo::orderBy('id', 'asc')->get();   
        $this->estantes = Estante::orderBy('id', 'asc')->get();   
        $this->mesas = Mesa::orderBy('id', 'asc')->get(); 
        $this->grupos = Grupo::orderBy('id', 'asc')->get();   
        $this->cuentas = Cuenta::orderBy('id', 'asc')->get();   
        $this->unidades = Unidad::orderBy('id', 'asc')->get();   
        $this->categorias = Categoria::orderBy('id', 'asc')->get();   
        $this->subcategorias = Subcategoria::orderBy('id', 'asc')->get();   
        return view('livewire.create-producto');
    }

}
