<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateGrupo extends Component
{
    public $grupo;
    public $grupoId;
    public $action;
    public $button;

    protected function getRules()
    {
        $rules = ($this->action == "updateGrupo" . $this->grupoId) ? [
            'grupo.grupo' => 'required',
        ] : [
            'grupo.nombre_grupo' => 'required|min:8|confirmed',
            'grupo.grupo' => 'required',
            'grupo.cuenta_a' => 'required',
            'grupo.partida_a' => 'required'
        ];

        return array_merge([
            'user.name' => 'required|min:3',
            'user.lastname' => 'required|min:3',
            'user.username' => 'required|min:3',
            'user.email' => 'required|email|unique:users,email'
        ], $rules);
    }

    public function createGrupo ()
    {
        
        Grupo::create($this->grupo);

        $this->emit('saved');
        $this->reset('grupo');
    }

    public function updateGrupo ()
    {
        
        Grupo::query()
            ->where('id', $this->grupoId)
            ->update([
                "nombre_grupo" => $this->grupo->nombre_grupo,
            ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->grupo && $this->grupoId) {
            $this->grupo = Grupo::find($this->grupoId);
        }

        $this->button = create_button($this->action, "Grupo");
    }

    public function render()
    {
        return view('livewire.create-grupo');
    }
}
