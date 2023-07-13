<?php

namespace App\Http\Livewire;

use App\Models\Cuenta;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateCuenta extends Component
{
    public $cuenta;
    public $cuentaId;
    public $action;
    public $button;

    protected function getRules()
    {
        $rules = ($this->action == "updateCuenta" . $this->cuentaId) ? [
            'cuenta.nombre_cuenta' => 'required',
        ] : [
            'cuenta.nombre_cuenta' => 'required',
            'cuenta.codigo_cuenta' => 'required'
        ];

        return array_merge([
            'user.name' => 'required|min:3',
            'user.lastname' => 'required|min:3',
            'user.username' => 'required|min:3',
            'user.email' => 'required|email|unique:users,email'
        ], $rules);
    }

    public function createCuenta ()
    {
        
        Cuenta::create($this->cuenta);

        $this->emit('saved');
        $this->reset('cuenta');
    }

    public function updateCuenta ()
    {
        
        Cuenta::query()
            ->where('id', $this->cuentaId)
            ->update([
                "nombre_cuenta" => $this->cuenta->nombre_cuenta,
                "codigo_cuenta" => $this->cuenta->codigo_cuenta,
            ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->cuenta && $this->cuentaId) {
            $this->cuenta = Cuenta::find($this->cuentaId);
        }

        $this->button = create_button($this->action, "Cuenta");
    }

    public function render()
    {
        return view('livewire.create-cuenta');
    }
}
