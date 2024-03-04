<?php

namespace App\Http\Livewire;

use App\Models\Mesa;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateMesa extends Component
{
    public $mesa;
    public $mesaId;
    public $action;
    public $button;

    protected function getRules()
    {
        $rules = ($this->action == "updateMesa" . $this->mesaId) ? [
            'mesa.n_mesa' => 'required',
        ] : [
            'mesa.n_mesa' => 'required',
    
        ];

        return array_merge([
            'mesa.n_mesa' => 'required|min:3',
        ], $rules);
    }

    public function createMesa ()
    {
        
        Mesa::create($this->mesa);

        $this->emit('saved');
        $this->reset('mesa');
    }

    public function updateMesa()
    {
        
        Mesa::query()
            ->where('id', $this->mesaId)
            ->update([
                "n_mesa" => $this->mesa->n_mesa,
            ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->mesa && $this->mesaId) {
            $this->mesa = Mesa::find($this->mesaId);
        }

        $this->button = create_button($this->action, "Mesa");
    }

    public function render()
    {
        return view('livewire.create-mesa');
    }
}
