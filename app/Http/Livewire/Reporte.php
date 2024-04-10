<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use Carbon\Carbon;
use Livewire\Component;

class Reporte extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    public function render()
    {
        return view('livewire.reporte');
    }

    public function vencimiento()
    {
        // Obtener artículos próximos a caducar
        $articulosCaducar = Entrada::whereDate('fecha_caducidad', '>=', Carbon::now())
            ->orderBy('fecha_caducidad')
            ->orderBy($this->sort, $this->direction)
            ->get();

        return view('pages.reporte.reporte-data', compact('articulosCaducar'));
    }

    public function stock()
    {
        // Obtener artículos próximos a caducar
        $articulosCaducar = Entrada::whereDate('fecha_caducidad', '>=', Carbon::now())
            ->orderBy('fecha_caducidad')
            ->orderBy($this->sort, $this->direction)
            ->get();

        return view('pages.reporte.reporte-stock', compact('articulosCaducar'));
    }

    public function order($sort){ //Metodo para ordenar
        if ($this->sort == $sort) {
            if($this->direction == 'desc'){
                $this->direction ='asc';
            }
            else{
                $this->direction = 'desc';
            }
        }
        else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

}
