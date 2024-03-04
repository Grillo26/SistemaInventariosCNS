<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateProveedor extends Component
{
    public $proveedor;
    public $proveedorId;
    public $action;
    public $button;

    protected function getRules()
    {
        $rules = ($this->action == "updateProveedor" . $this->proveedorId) ? [
            'proveedor.nombre_proveedor' => 'required',
            'proveedor.email' => 'required',
        ] : [
            'proveedor.nombre_proveedor' => 'required',
            'proveedor.email' => 'required',
    
        ];

        return array_merge([
            'proveedor.nombre_proveedor' => 'required|min:3',
        ], $rules);
    }

    public function createProveedor ()
    {
        
        Proveedor::create($this->proveedor);

        $this->emit('saved');
        $this->reset('proveedor');
    }

    public function updateProveedor()
    {
        
        Proveedor::query()
            ->where('id', $this->proveedorId)
            ->update([
                "nombre_proveedor" => $this->proveedor->nombre_proveedor,
                "email" => $this->proveedor->email,
            ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->proveedor && $this->proveedorId) {
            $this->proveedor = Proveedor::find($this->proveedorId);
        }

        $this->button = create_button($this->action, "Proveedor");
    }

    public function render()
    {
        return view('livewire.create-proveedor');
    }
}
