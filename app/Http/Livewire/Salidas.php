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
use App\Models\Salida;
use App\Models\Comprobante;

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
    $descripcion, $fecha_salida, $obs,
    $pasillo_idPasillo, $estante_idEstante, $mesa_idMesa, 
    $cantidad, $cantidad_salida, $cantidad_stockTotal=0, $nombre_proveedor;
    public $n_lote, $ultimoNumeroLote;


    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];

    public function closeModal(){
        $this->open = false;
        $this->limpiarCampos();

    }

    public function updatedCodigoProducto($value){ //Funcion para seleccionar id y mostrar en inputs disableds
        if ($value) {
            $producto = Producto::find($value);
            if ($producto) {
                $this->nombre_producto = $producto->nombre_producto;
                $this->pasillo_idPasillo = Pasillo::find($producto->pasillo_idPasillo)->n_pasillo;
                $this->estante_idEstante = Estante::find($producto->estante_idEstante)->n_estante;
                $this->mesa_idMesa = Mesa::find($producto->mesa_idMesa)->n_mesa;

                $cantidadEntradas = Inventario::where('producto_id', $value)->sum('cantidad_entrada');
                $cantidadSalidas = Inventario::where('producto_id', $value)->sum('cantidad_salida');
                $this->cantidad= $cantidadEntradas - $cantidadSalidas;

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

    public function mount(){
        // Obtener el último número de lote almacenado en la base de datos
        $ultimoNumeroLote = Comprobante::max('n_comprobante');
        if($ultimoNumeroLote == null){
            $ultimoNumeroLote = 1000;
            $this->n_lote = $ultimoNumeroLote;
        }
        else{
            $nuevoNumeroLote = $ultimoNumeroLote ? $ultimoNumeroLote + 1 : 1001;
            $this->n_lote = $nuevoNumeroLote;
        }

    }

    public function guardar(){

        $salida = Salida::updateOrCreate(
        [
            'producto_idProducto' => $this->codigo_producto,
            'fecha_salida' => $this->fecha_salida,
            'cantidad' => $this->cantidad_salida,
            'obs' => $this->obs,
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
                'cantidad_entrada' => 0,
                'cantidad_salida' => $this->cantidad_salida,
                'proveedor_idProveedor' => $this->nombre_proveedor,
                'obs' => $this->obs,
            ]
        );

        // Crear un registro en la tabla 'comprobantes'
        $comprobante = Comprobante::updateOrCreate(
            [
                'n_comprobante' => $this->n_lote,
                'detalle' => $this->obs,
                'salida_idSalida' => $salida->id,
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
        
        $this->pasillos = Pasillo::orderBy('id', 'asc')->get();   
        $this->estantes = Estante::orderBy('id', 'asc')->get();   
        $this->mesas = Mesa::orderBy('id', 'asc')->get(); 
        $this->proveedors = Proveedor::orderBy('id', 'asc')->get();

        $this->proveedores = Inventario::select('proveedor_idProveedor')
        ->groupBy('proveedor_idProveedor')
        ->get();
 
        
        $this->productos = Producto::join('entradas', 'productos.id', '=', 'entradas.producto_idProducto')
        ->orderBy('productos.id', 'asc')
        ->select('productos.*')
        ->distinct()
        ->get();

        $salidas = Salida::where('producto_idProducto', 'like', '%' . $this->search . '%')
        ->orWhereHas('productos', function($query) { //Realiza la búsqueda con la llave foránea en otra tabla
            $query->where('codigo_producto', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('productos', function($query) {
            $query->where('nombre_producto', 'like', '%' . $this->search . '%');
        })
        ->orwhere('fecha_salida', 'like', '%' . $this->search . '%')
        ->orwhere('cantidad', 'like', '%' . $this->search . '%')
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
