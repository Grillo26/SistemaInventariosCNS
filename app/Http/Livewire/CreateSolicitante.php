<?php

namespace App\Http\Livewire;

use App\Models\Solicitante;
use App\Models\Unidad;
use App\Models\Producto;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateSolicitante extends Component
{
    public $solicitante; 
    public $solicitanteId;
    public $action;
    public $button;

    public $nombre_producto, $codigo_producto;

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

    protected function getRules()
    {
        $rules = ($this->action == "updateSolicitante" . $this->solicitanteId) ? [
            'solicitante.nombre_u' => 'required',
            'solicitante.codigo_u' => 'required',
            'solicitante.codigo_u2' => 'required',
        ] : [
            'solicitante.nombre_u' => 'required',
            'solicitante.codigo_u' => 'required',
            'solicitante.codigo_u2' => 'required',
    
        ];

        return array_merge([
            'solicitante.nombre_u' => 'required|min:3',
            'solicitante.codigo_u' => 'required|min:3',
            'solicitante.codigo_u2' => 'required|min:3',
        ], $rules);
    }

    public function createSolicitante ()
    {
        $data = $this->solicitante;
        $data['estado_idEstado'] = 1;
        $data['producto_idProducto'] = $this-> codigo_producto;
        Solicitante::create($data);

        $this->emit('saved');
        $this->reset('solicitante');
    }

    public function updateSolicitante()
    {
        
        Solicitante::query()
            ->where('id', $this->solicitanteId)
            ->update([
                "nombre_u" => $this->solicitante->nombre_u,
                "codigo_u" => $this->solicitante->codigo_u,
                "codigo_u2" => $this->solicitante->codigo_u2,
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
        $this->unidades = Unidad::orderBy('id', 'asc')->get();  
        $this->productos = Producto::orderBy('id', 'asc')->get();  
        return view('livewire.create-solicitante');
    }
}
