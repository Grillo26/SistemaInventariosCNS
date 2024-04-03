<?php

namespace App\Http\Livewire;
use App\Models\CompraProducto;
use Carbon\Carbon;
use Livewire\Component;

class Reporte extends Component
{
    public function render()
    {
        return view('livewire.reporte');
    }

    public function vencimiento()
    {
        // Obtener artículos próximos a caducar
        $articulosCaducar = CompraProducto::whereDate('fecha_caducidad', '>=', Carbon::now())
            ->orderBy('fecha_caducidad')
            ->get();

        return view('pages.reporte.reporte-data', ['articulosCaducar' => $articulosCaducar]);
    }

    public function stock()
    {
        // Obtener artículos próximos a caducar
        $articulosCaducar = CompraProducto::whereDate('fecha_caducidad', '>=', Carbon::now())
            ->orderBy('fecha_caducidad')
            ->get();

        return view('pages.reporte.reporte-stock', ['articulosCaducar' => $articulosCaducar]);
    }
}
