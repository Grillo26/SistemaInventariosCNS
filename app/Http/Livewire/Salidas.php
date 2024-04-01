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
use App\Models\Salida;

use Livewire\Component;

class Salidas extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    public $open = false;
    public $verifiEdit = false;

    public $codigo_producto, $nombre_producto, 
    $descripcion, $fecha_salida,
    $pasillo_idPasillo, $estante_idEstante, $mesa_idMesa, 
    $cantidad, $cantidad_salida, $cantidad_stockTotal=0;

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
                $this->descripcion = $producto-> descripcion;
                $this->pasillo_idPasillo = Pasillo::find($producto->pasillo_idPasillo)->n_pasillo;
                $this->estante_idEstante = Estante::find($producto->estante_idEstante)->n_estante;
                $this->mesa_idMesa = Mesa::find($producto->mesa_idMesa)->n_mesa;
                $this->cantidad = $producto -> cantidad;
                $this->cantidad = number_format($this->cantidad, 0);
                //Mediante el id accedemos a la tabla correspondiente y extraemos su nombre
                //$this->nombre_grupo = Grupo::find($producto->grupo_idGrupo)->nombre_grupo; 
          
            } else {
                $this->nombre_producto = null;
                $this->descripcion = null;
                $this->pasillo_idPasillo = null;
                $this->estante_idEstante = null;
                $this->mesa_idMesa = null;
                $this->cantidad = null;
            }
        } else {
            $this->nombre_producto = null;
            $this->descripcion = null;
            $this->pasillo_idPasillo = null;
            $this->estante_idEstante = null;
            $this->mesa_idMesa = null;
            $this->cantidad = null;
        }  
    }

    public function calcular(){
        $this->cantidad_stockTotal = $this->cantidad - $this->cantidad_salida;

    }

    public function guardar(){

        if (!$this->codigo_producto) {
            // Si el ID está vacío, no hagas nada
            return;
        }

            // Encuentra el registro de CompraProducto por el ID seleccionado
        $compraProducto = CompraProducto::find($this->codigo_producto);

        // Realiza la lógica de actualización basada en el objeto $compraProducto
        if ($compraProducto) {
            $cantidad_update = $compraProducto->cantidad - $this->cantidad_salida;
            $compraProducto->update([
                'cantidad' => $cantidad_update
            ]);
        }

        Salida::updateOrCreate(
        [
            'producto_idProducto' => $this->codigo_producto,
            'fecha_salida' => $this->fecha_salida,
            'stock_disponible' => $this->cantidad,
            'cantidad_salida' => $this->cantidad_salida,
            'cantidad_stockTotal' => $this->cantidad_stockTotal
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
        $this->entradas = CompraProducto::orderBy('id', 'asc')->get(); 
        
        $salidas = Salida::where('producto_idProducto', 'like', '%' . $this->search . '%')
        ->orWhereHas('productos', function($query) { //Realiza la búsqueda con la llave foránea en otra tabla
            $query->where('codigo_producto', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('productos', function($query) {
            $query->where('nombre_producto', 'like', '%' . $this->search . '%');
        })
        ->orwhere('fecha_salida', 'like', '%' . $this->search . '%')
        ->orwhere('stock_disponible', 'like', '%' . $this->search . '%')
        ->orwhere('cantidad_salida', 'like', '%' . $this->search . '%')
        ->orwhere('cantidad_stockTotal', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->get();
 
        return view('livewire.salidas', compact ('salidas')); 
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
        $salida = Salida::findOrFail($id);
        $this->producto_idProducto = $salida->producto_idProducto;
        $this->fecha_salida = $salida->fecha_salida;
        $this->cantidad = $salida->stock_disponible;
        $this->cantidad_salida = $salida->cantidad_salida;
        $this->cantidad_stockTotal = $salida->cantidad_stockTotal;
        $this->open=true;
        $this->verifiEdit=true;
    }



    public function delete_item($id)
    {
        $data = Salida::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Error al eliminar datos" . $this->id
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->id . " Eliminado con éxito!"
        ]);
    }

    public function limpiarCampos(){
        $this->codigo_producto= '';
        $this->fecha_salida = '';
        $this->cantidad = '';
        $this->cantidad_salida = '';
        $this->cantidad_stockTotal = '';
        $this->total = 0;

        
    }
    
}
