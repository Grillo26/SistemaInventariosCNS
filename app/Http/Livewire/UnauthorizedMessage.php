<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UnauthorizedMessage extends Component
{
    public function render()
    {
        return view('livewire.unauthorized-message');
    }
}
