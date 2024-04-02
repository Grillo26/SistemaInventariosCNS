<?php

namespace App\Http\Livewire;
use App\Models\User;


use Livewire\Component;

class Dashboard extends Component
{


    public function mount()
    {
        $this->usersCount = User::count();
    }

    public function render()
    {

        return view('livewire.dashboard');
    }

    public function renderuser(){
        return viwe('livewire.dashuser');
    }
}
