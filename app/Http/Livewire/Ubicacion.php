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

use Carbon\Carbon;

use Livewire\Component;

class Ubicacion extends Component
{

    public $codigo_producto, $nombre_producto;
    public $pasillo, $estante, $mesa;



    public function updatedCodigoProducto($value){ //Funcion para seleccionar id y mostrar en inputs disableds
        if ($value) {
            $producto = Producto::find($value);
            if ($producto) {
                $this->nombre_producto = $producto->nombre_producto;
                $this->pasillo = Pasillo::find($producto->pasillo_idPasillo)->n_pasillo; 
                $this->estante = Estante::find($producto->estante_idEstante)->n_estante; 
                $this->mesa = Mesa::find($producto->mesa_idMesa)->n_mesa; 

                //Mediante el id accedemos a la tabla correspondiente y extraemos su nombre
                //$this->nombre_grupo = Grupo::find($producto->grupo_idGrupo)->nombre_grupo; 

                
            } else {
                $this->nombre_producto = null;
                $this->pasillo = null;
                $this->estante = null;
                $this->mesa = null;


            }
        } else {
            $this->nombre_producto = null;
            $this->pasillo = null;
            $this->estante = null;
            $this->mesa = null;

        }
    }
    public function render(){ 
     
        $this->pasillos = Pasillo::orderBy('id', 'asc')->get();   
        $this->estantes = Estante::orderBy('id', 'asc')->get();   
        $this->mesas = Mesa::orderBy('id', 'asc')->get(); 

        $this->productos = Producto::join('entradas', 'productos.id', '=', 'entradas.producto_idProducto')
        ->orderBy('productos.id', 'asc')
        ->select('productos.*')
        ->distinct()
        ->get();
    
        return view('livewire.ubicacion'); 
    }

    
}
