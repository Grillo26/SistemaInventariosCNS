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

use Livewire\Component;

class Entradas extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    public $open = false;
    public $verifiEdit = false;

    public $codigo_producto, $nombre_producto, 
    $nombre_proveedor, $descripcion, $pasillo, $estante, $mesa, 
    $fecha_adquisicion, $fecha_caducidad,
     $nombre_grupo, $nombre_cuenta, $nombre_unidad, 
    $cantidad=0, $valor_articulo=0, $total=0;

    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];

    public function updatedCodigoProducto($value)
    {
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
    public function calcular()
    {
        $this->total = $this->valor_articulo * $this->cantidad;
    }


    public function render(){
        $this->productos = Producto::orderBy('id', 'asc')->get();
        $this->entradas = CompraProducto::orderBy('id', 'asc')->get();
        $this->grupos = Grupo::orderBy('id', 'asc')->get();   
        $this->cuentas = Cuenta::orderBy('id', 'asc')->get();   
        $this->unidades = Unidad::orderBy('id', 'asc')->get();   
        $this->proveedors = Proveedor::orderBy('id', 'asc')->get();   
        $this->pasillos = Pasillo::orderBy('id', 'asc')->get();   
        $this->estantes = Estante::orderBy('id', 'asc')->get();   
        $this->mesas = Mesa::orderBy('id', 'asc')->get();   

        return view('livewire.entradas'); 
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

    public function guardar(){
        CompraProducto::updateOrCreate(['id'=>$this->id_entrada],
        [
            'fecha__compra' => $this->fecha_compra,
            'horac' => $this->horac,
            'total' => $this->total,
            'ady' => $this->ady,
            'proveedor_idProveedor' => $this->proveedor_idProveedor
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

    public function editar($id){
        $entrada = CompraProducto::findOrFail($id);
        $this->id_entrada = $id;
        $this->fecha_compra = $entrada->fecha_compra;
        $this->horac = $entrada->horac;
        $this->total = $entrada->total;
        $this->ady = $entrada->ady;
        $this->proveedor_idProveedor = $entrada->proveedor_idProveedor;
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
        $this->id_entrada = '';
        $this->fecha_compra = '';
        $this->horac = '';
        $this->total ='';
        $this->ady = '';
        $this->proveedor_idProveedor ='';


    }
    
}
