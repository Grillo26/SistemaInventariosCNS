<?php

namespace App\Http\Livewire;

use App\Models\Dll;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateDll extends Component
{
    public $dll;
    public $dllId;
    public $action;
    public $button;

    protected function getRules()
    {
        $rules = ($this->action == "updateDll" . $this->dllId) ? [
            'dll.nombre' => 'required',
        ] : [
            'dll.nombre' => 'required',
    
        ];

        return array_merge([
            'dll.nombre' => 'required|min:3',
        ], $rules);
    }

    public function createDll ()
    {
        
        Dll::create($this->dll);

        $this->emit('saved');
        $this->reset('dll');
    }

    public function updateDll()
    {
        
        Dll::query()
            ->where('id', $this->dllId)
            ->update([
                "nombre" => $this->dll->nombre,
            ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->dll && $this->dllId) {
            $this->dll = Dll::find($this->dllId);
        }

        $this->button = create_button($this->action, "Dll");
    }

    public function render()
    {
        return view('livewire.create-dll');
    }
}
