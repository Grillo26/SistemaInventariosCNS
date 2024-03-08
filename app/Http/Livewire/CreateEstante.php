<?php

namespace App\Http\Livewire;

use App\Models\Estante;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateEstante extends Component
{
    public $estante;
    public $estanteId;
    public $action;
    public $button;

    protected function getRules()
    {
        $rules = ($this->action == "updateEstante" . $this->estanteId) ? [
            'estante.n_estante' => 'required',
            'estante.descripcion' => 'required',
        ] : [
            'estante.n_estante' => 'required',
            'estante.descripcion' => 'required'
    
        ];

        return array_merge([
            'estante.n_estante' => 'required|min:3'
            
        ], $rules);
    }

    public function createEstante ()
    {
        
        Estante::create($this->estante);

        $this->emit('saved');
        $this->reset('estante');
    }

    public function updateEstante ()
    {
        
        Estante::query()
            ->where('id', $this->estanteId)
            ->update([
                "n_estante" => $this->estante->n_estante,
                "descripcion" => $this->estante->descripcion
            ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->estante && $this->estanteId) {
            $this->estante = Estante::find($this->estanteId);
        }

        $this->button = create_button($this->action, "Estante");
    }

    public function render()
    {
        return view('livewire.create-estante');
    }
}
