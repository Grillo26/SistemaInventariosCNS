<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Inventario;
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

class Stock extends Component
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

    public $vencida, $dias_restantes;
    
    public function updatedCodigoProducto($value){ //Funcion para seleccionar id y mostrar en inputs disableds
        if ($value) {
            $producto = Producto::find($value);
            if ($producto) {
                $this->nombre_producto = $producto->nombre_producto;
                $this->cantidad = Inventario::where('producto_id', $value)
                ->sum('cantidad_entrada') - Inventario::where('producto_id', $value)
                ->sum('cantidad_salida');
                $this->fecha_caducidad = 23;
                //Mediante el id accedemos a la tabla correspondiente y extraemos su nombre
                //$this->nombre_grupo = Grupo::find($producto->grupo_idGrupo)->nombre_grupo; 

                // Convertir la fecha de caducidad a un objeto Carbon
                $this->fecha = Carbon::parse($this->fecha_caducidad);

                // Obtener la fecha actual
                $hoy = Carbon::now();

                // Verificar si la fecha de caducidad ya pasó
                if ($hoy->gt($this->fecha)) {
                    // Calcular cuántos días lleva vencido el artículo
                    $this->dias_vencidos = $hoy->diffInDays($this->fecha);
                    // Establecer la variable $vencida en true
                    $this->vencida = true;
                } else {
                    // Calcular cuántos días faltan para que el artículo venza
                    $this->dias_restantes =  $hoy->diffInDays($this->fecha);
                    // Establecer la variable $vencida en false
                    $this->vencida = false;
                }

                
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




    public function render(){
        
        $this->productos = Producto::join('entradas', 'productos.id', '=', 'entradas.producto_idProducto')
        ->orderBy('productos.id', 'asc')
        ->select('productos.*')
        ->distinct()
        ->get();
        

        return view('livewire.stock'); 
    }

    
}
