<?php

namespace App\Http\Livewire;
use App\Models\CompraProducto;
use App\Models\Grupo;
use App\Models\Cuenta;
use App\Models\Unidad;
use App\Models\Proveedor;
use App\Models\Pasillo;
use App\Models\Estante;
use App\Models\Mesa;
use App\Models\Producto;

use Carbon\Carbon;

use Livewire\Component;

class Ubicacion extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    public $open = false;
    public $verifiEdit = false;

    public $codigo_producto, $nombre_producto, 
    $nombre_proveedor, $descripcion, 
    $pasillo_idPasillo, $estante_idEstante, $mesa_idMesa, 
    $fecha_adquisicion, $fecha_caducidad, $proveedor_idProveedor, $email, $id_proveedor,
     $nombre_grupo, $nombre_cuenta, $nombre_unidad, 
    $cantidad, $cantidad_db, $valor_articulo, $total=0;

    public $pasillo, $estante, $mesa;

    public $vencida, $dias_restantes;
    
    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];

    public function closeModal(){ 
        $this->open = false;
        $this->limpiarCampos();
    }

    public function updatedCodigoProducto($value){ //Funcion para seleccionar id y mostrar en inputs disableds
        if ($value) {
            $producto = CompraProducto::find($value);
            if ($producto) {
                $this->nombre_producto = Producto::find($producto->producto_idProducto)->nombre_producto;
                $this->pasillo = Pasillo::find($producto->pasillo_idPasillo)->n_pasillo; 
                $this->estante = Estante::find($producto->estante_idEstante)->n_estante; 
                $this->mesa = Mesa::find($producto->mesa_idMesa)->n_mesa; 
                $this->descripcion = $producto->descripcion;

                //Mediante el id accedemos a la tabla correspondiente y extraemos su nombre
                //$this->nombre_grupo = Grupo::find($producto->grupo_idGrupo)->nombre_grupo; 

            
                
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
        CompraProducto::updateOrCreate(
        [
            'producto_idProducto' => $this->codigo_producto,
            'proveedor_idProveedor' => $this->nombre_proveedor,
            'descripcion' => $this->descripcion,
            'fecha_adquisicion' => $this->fecha_adquisicion,
            'pasillo_idPasillo' => $this->pasillo_idPasillo,
            'estante_idEstante' => $this->estante_idEstante,
            'mesa_idMesa' => $this->mesa_idMesa,
            'fecha_caducidad' => $this->fecha_caducidad,
            'cantidad' => $this->cantidad, //Esta cantidad es editable
            'cantidad_db' => $this->cantidad, //Esta candidad es el registro de ingreso
            'valor_articulo' => $this->valor_articulo,
            'total' => $this->total,
        ]);
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
        
        $entradas = CompraProducto::where('producto_idProducto', 'like', '%' . $this->search . '%')
        ->orwhere('proveedor_idProveedor', 'like', '%' . $this->search . '%')
        ->orwhere('cantidad_db', 'like', '%' . $this->search . '%')
        ->orwhere('fecha_adquisicion', 'like', '%' . $this->search . '%')
        ->orwhere('fecha_caducidad', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->get();

        return view('livewire.ubicacion', compact ('entradas')); 
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
        $entrada = CompraProducto::findOrFail($id);
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
        $data = CompraProducto::find($id);

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
