<?php

namespace App\Http\Livewire;

use App\Models\Solicitante;
use App\Models\Estado;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateSolicitante extends Component
{
    public $solicitante; 
    public $solicitanteId;
    public $action;
    public $button;

    public $nombre_producto, $codigo_producto, $estado_idEstado, $cantidad;
    public $referencia, $detalle;
    public $solicitudes = [];

    public function updatedCodigoProducto($value){ //Funcion para seleccionar id y mostrar en inputs disableds
        if ($value) {
            $producto = Producto::find($value);
            if ($producto) {
                $this->nombre_producto = $producto->nombre_producto;
                //Mediante el id accedemos a la tabla correspondiente y extraemos su nombre
            } else {
                $this->nombre_producto = null;
            }
        } else {
            $this->nombre_producto = null;
        }
    }

    public function agregarSolicitud()
    {
        // Agregar la solicitud actual a la colección de solicitudes
        $this->solicitudes[] = [
            
            'cantidad' => $this->cantidad,
            'producto_idProducto' => $this->codigo_producto,
            'nombre_producto' => $this->nombre_producto,
         
            // Agregar aquí los campos que necesites
        ];

        $this->reset(['codigo_producto', 'nombre_producto','cantidad']);
        $this->emit('resetSelect2');

        
    }

    protected function getRules()
    {
        $rules = ($this->action == "updateSolicitante" . $this->solicitanteId) ? [
            'solicitante.referencia' => 'required',
        ] : [
            'solicitante.referencia' => 'required',
            'solicitante.detalle' => 'required',
            'solicitante.cantidad' => 'required',
            'solicitante.estado_idEstado' => 'required',
            'solicitante.producto_idProducto' => 'required',
            'solicitante.nombre_solicitante' => 'required',
    
        ];

        return array_merge([
            'solicitante.nombre_u' => 'required|min:3',
            'solicitante.codigo_u' => 'required|min:3',
            'solicitante.codigo_u2' => 'required|min:3',
        ], $rules);
    }

    public function createSolicitante ()
    {
        if (count($this->solicitudes) > 0) {
            foreach ($this->solicitudes as $solicitud) {

                $solicitud['referencia'] = $this->referencia;
                $solicitud['detalle'] = $this->detalle;
                $solicitud['user_id'] = auth()->id(); // Obtener el ID del usuario autenticado
                $solicitud['estado_idEstado'] = 1;
                
                Solicitante::create($solicitud);

            }
        }
        elseif (count($this->solicitudes) === 0) {
            $data = $this->solicitante;
            $data['referencia'] = $this->referencia;
            $data['detalle'] = $this->detalle;
            $data['cantidad'] = $this->cantidad;
            $data['user_id'] = auth()->id(); // Obtiene el ID del usuario autenticado
            $data['producto_idProducto'] = $this->codigo_producto;
            $data['estado_idEstado'] = 1;
            Solicitante::create($data);
        }


        $this->emit('saved');
        $this->reset(['solicitudes', 'solicitante']);
    }

    public function updateSolicitante()
    {
        
        Solicitante::query()
            ->where('id', $this->solicitanteId)
            ->update([
                "referencia" => $this->solicitante->referencia,
                "detalle" => $this->solicitante->detalle,
                "cantidad" => $this->solicitante->cantidad,
                "nombre_solicitante" => $this->solicitante->nombre_solicitante,
                "producto_idProducto" => $this->solicitante->producto_idProducto,
                "estado_idEstado" => $this->solicitante->estado_idEstado,
            ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->solicitante && $this->solicitanteId) {
            $this->solicitante = Solicitante::find($this->solicitanteId);
        }

        $this->button = create_button($this->action, "Solicitante");
    }

    public function render()
    {
        $this->estados = Estado::orderBy('id', 'asc')->get();  
        $this->productos = Producto::orderBy('id', 'asc')->get();  
        $this->users = User::orderBy('id', 'asc')->get();  
        return view('livewire.create-solicitante');
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
