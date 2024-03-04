<?php

namespace App\Http\Livewire;

use App\Models\Solicitante;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateSolicitante extends Component
{
    public $solicitante;
    public $solicitanteId;
    public $action;
    public $button;

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
        
        Solicitante::create($this->solicitante);

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
        return view('livewire.create-solicitante');
    }
}
