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
        return view('pages.reporte.reporte-data',);
    }

    public function stock()
    {
        return view('pages.reporte.reporte-stock');
    }

    public function sinsalida(){
        return view('pages.reporte.reporte-sinsalida');
    }

    public function almacen(){
        return view('pages.reporte.reporte-almacen');
    }

    public function entradas(){
        return view('pages.reporte.reporte-entradas');
    }

}
