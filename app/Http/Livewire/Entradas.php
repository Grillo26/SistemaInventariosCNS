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

    public $codigo_producto, $nombre_producto;

    public $fecha_compra, $horac, $total, $ady, $proveedor_idProveedor, $id_entrada;
    protected $listeners = [ "deleteItem" => "delete_item" ];
    public function updatedCodigoProducto($value)
    {
        if ($value) {
            $producto = Producto::find($value);
            if ($producto) {
                $this->nombre_producto = $producto->nombre_producto;
            } else {
                $this->nombre_producto = null;
            }
        } else {
            $this->nombre_producto = null;
        }
    }


    public function render(){
        $this->productos = Producto::orderBy('id', 'asc')->get();
        $this->entradas = CompraProducto::orderBy('id', 'asc')->get();
        $this->grupos = Grupo::orderBy('id', 'asc')->get();   
        $this->cuentas = Cuenta::orderBy('id', 'asc')->get();   
        $this->unidades = Unidad::orderBy('id', 'asc')->get();   
        $this->proveedores = Proveedor::orderBy('id', 'asc')->get();   
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
