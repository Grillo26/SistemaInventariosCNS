<?php

namespace App\Http\Livewire;

use App\Models\Unidad;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUnidad extends Component
{
    public $unidad;
    public $unidadId;
    public $action;
    public $button;

    protected function getRules()
    {
        $rules = ($this->action == "updateUnidad" . $this->unidadId) ? [
            'unidad.nombre_unidad' => 'required'
        ] : [
            'unidad.nombre_unidad' => 'required'
    
        ];

        return array_merge([
            'unidad.nombre_unidad' => 'required|min:3'
            
        ], $rules);
    }

    public function createUnidad ()
    {
        
        Unidad::create($this->unidad);

        $this->emit('saved');
        $this->reset('unidad');
    }

    public function updateUnidad ()
    {
        
        Unidad::query()
            ->where('id', $this->unidadId)
            ->update([
                "nombre_unidad" => $this->unidad->nombre_unidad
            ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->unidad && $this->unidadId) {
            $this->unidad = Unidad::find($this->unidadId);
        }

        $this->button = create_button($this->action, "Unidad");
    }

    public function render()
    {
        return view('livewire.create-unidad');
    }
}
