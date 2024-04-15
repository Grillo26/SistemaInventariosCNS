<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Grupo;
use App\Models\Cuenta;
use App\Models\Unidad;
use App\Models\Proveedor;
use App\Models\Pasillo;
use App\Models\Estante;
use App\Models\Mesa;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\Comprobante;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithDataTable;

class Entradas extends Component
{
    use WithPagination, WithDataTable;
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    public $open = false;
    public $verifiEdit = false;

    public $codigo_producto, $nombre_producto, 
    $nombre_proveedor, $descripcion, 
    $fecha_adquisicion, $fecha_caducidad,
     $nombre_grupo, $nombre_cuenta, $nombre_unidad, 
    $cantidad, $valor_articulo, $total=0, $n_lote, $ultimoNumeroLote;

    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];

    public function closeModal(){ 
        $this->open = false;
        $this->limpiarCampos();
    }

    public function mount(){
        // Obtener el último número de lote almacenado en la base de datos
        $ultimoNumeroLote = Entrada::max('n_lote');
        if($ultimoNumeroLote == null){
            $ultimoNumeroLote = 1000;
            $this->n_lote = $ultimoNumeroLote;
        }
        else{
            $nuevoNumeroLote = $ultimoNumeroLote ? $ultimoNumeroLote + 1 : 1001;
            $this->n_lote = $nuevoNumeroLote;
        }

    }

    public function updatedCodigoProducto($value){ //Funcion para seleccionar id y mostrar en inputs disableds
        if ($value) {
            $producto = Producto::find($value);
            if ($producto) {
                $this->nombre_producto = $producto->nombre_producto;
                //Mediante el id accedemos a la tabla correspondiente y extraemos su nombre
                $this->nombre_grupo = Grupo::find($producto->grupo_idGrupo)->nombre_grupo; 
                $this->nombre_cuenta = Cuenta::find($producto->cuenta_idCuenta)->nombre_cuenta;
                $this->nombre_unidad = Unidad::find($producto->unidad_idUnidad)->nombre_unidad;
            } else {
                $this->nombre_producto = null;
                $this->nombre_grupo = null;
                $this->nombre_cuenta = null;
                $this->nombre_unidad = null;
            }
        } else {
            $this->nombre_producto = null;
            $this->nombre_grupo = null;
            $this->nombre_cuenta = null;
            $this->nombre_unidad = null;
        }
    }

    public function calcular(){
        $this->total = $this->valor_articulo * $this->cantidad;
    

    }

    public function guardar(){

        
        
        $entrada = Entrada::updateOrCreate(
        [
            'producto_idProducto' => $this->codigo_producto,
            'proveedor_idProveedor' => $this->nombre_proveedor,
            'descripcion' => $this->descripcion,
            'fecha_adquisicion' => $this->fecha_adquisicion,
            'fecha_caducidad' => $this->fecha_caducidad,
            'cantidad' => $this->cantidad, //Esta cantidad es editable
            'valor_articulo' => $this->valor_articulo,
            'n_lote' => $this->n_lote,
        ]);

        // Crear un registro en la tabla 'inventarios' o actualizar si ya existe
        Inventario::updateOrCreate(
            [
                'producto_id' => $this->codigo_producto,
                'fecha' => now()->toDateString(),
                'hora' => now()->toTimeString(),
            ],
            [
                'cantidad' => $this->cantidad,
                'cantidad_entrada' => $this->cantidad,
                'cantidad_salida' => 0,
                'proveedor_idProveedor' => $this->nombre_proveedor,
                'obs' => $this->descripcion,
            ]
        );

        // Crear un registro en la tabla 'comprobantes'
        $comprobante = Comprobante::updateOrCreate(
            [
                'n_comprobante' => $this->n_lote,
                'detalle' => $this->descripcion,
                'entrada_idEntrada' => $entrada->id,
            ],
        );

        $this->limpiarCampos();
        
        $this->open=false;
        $this->emit('saved');

        //Para alerta de Editado
        if($this->verifiEdit == true){
            $this->emit('edit');
        }
        $this->verifiEdit=false;
    }


    public function render(){
        $this->productos = Producto::orderBy('id', 'asc')->get();
        $this->grupos = Grupo::orderBy('id', 'asc')->get();   
        $this->cuentas = Cuenta::orderBy('id', 'asc')->get();   
        $this->unidades = Unidad::orderBy('id', 'asc')->get();   
        $this->proveedors = Proveedor::orderBy('id', 'asc')->get();   
        $this->pasillos = Pasillo::orderBy('id', 'asc')->get();   
        $this->estantes = Estante::orderBy('id', 'asc')->get();   
        $this->mesas = Mesa::orderBy('id', 'asc')->get(); 
        
        $entradas = Entrada::where('producto_idProducto', 'like', '%' . $this->search . '%')

        ->orWhereHas('productos', function($query) { //Realiza la búsqueda con la llave foránea en otra tabla
            $query->where('codigo_producto', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('productos', function($query) {
            $query->where('nombre_producto', 'like', '%' . $this->search . '%');
        })
        ->orwhere('fecha_adquisicion', 'like', '%' . $this->search . '%')   
        ->orwhere('fecha_caducidad', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->get();


        return view('livewire.entradas', compact ('entradas')); 
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

    

    public function editar($id){
        $entrada = Entrada::findOrFail($id);
        $this->producto_idProducto = $entrada->producto_idProducto;
        $this->proveedor_idProveedor = $entrada->proveedor_idProveedor;
        $this->descripcion = $entrada->descripcion;
        $this->fecha_adquisicion = $entrada->fecha_adquisicion;
        $this->pasillo_idPasillo = $entrada->pasillo_idPasillo;
        $this->estante_idEstante = $entrada->estante_idEstante;
        $this->mesa_idMesa = $entrada->mesa_idMesa;
        $this->fecha_caducidad = $entrada->fecha_caducidad;
        $this->cantidad_db = $entrada->cantidad;
        $this->valor_articulo = $entrada->valor_articulo;
        $this->total = $entrada->total;
        $this->open=true;
        $this->verifiEdit=true;
    }



    public function delete_item($id)
    {
        $data = Entrada::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Error al eliminar datos" . $this->id_entrada
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->id_entrada . " Eliminado con éxito!"
        ]);
    }

    public function limpiarCampos(){
        $this->codigoProducto = '';
        $this->nombreProducto = '';
        $this->proveedor_idProveedor = '';
        $this->descripcion = '';
        $this->fecha_adquisicion = '';
        $this->pasillo_idPasillo = '';
        $this->estante_idEstante = '';
        $this->mesa_idMesa = '';
        $this->fecha_caducidad = '';
        $this->cantidad = null;
        $this->valor_articulo = null;
        $this->total = 0;


    }
    
}
