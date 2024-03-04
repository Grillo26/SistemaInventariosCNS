<?php

namespace App\Http\Livewire;

use App\Models\Pasillo;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreatePasillo extends Component
{
    public $pasillo;
    public $pasilloId;
    public $action;
    public $button;

    protected function getRules()
    {
        $rules = ($this->action == "updatePasillo" . $this->pasilloId) ? [
            'pasillo.n_pasillo' => 'required',
        ] : [
            'pasillo.n_pasillo' => 'required',
    
        ];

        return array_merge([
            'pasillo.n_pasillo' => 'required|min:3',
        ], $rules);
    }

    public function createPasillo ()
    {
        
        Pasillo::create($this->pasillo);

        $this->emit('saved');
        $this->reset('pasillo');
    }

    public function updatePasillo()
    {
        
        Pasillo::query()
            ->where('id', $this->pasilloId)
            ->update([
                "n_pasillo" => $this->pasillo->n_pasillo,
            ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->pasillo && $this->pasilloId) {
            $this->pasillo = Pasillo::find($this->pasilloId);
        }

        $this->button = create_button($this->action, "Pasillo");
    }

    public function render()
    {
        return view('livewire.create-pasillo');
    }
}
