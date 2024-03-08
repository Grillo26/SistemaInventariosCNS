<?php

namespace App\Http\Livewire;
use App\Models\Estado;

use Livewire\Component;

class Estad extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    public $open = false;
    public $verifiEdit = false;

    public $estado, $id_estado;

    protected $listeners = [ "deleteItem" => "delete_item" ];

    public function render(){
        $estados = Estado::where('estado', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->get();
        return view('livewire.estado', compact ('estados'));
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

    public function guardar(){
        Estado::updateOrCreate(['id'=>$this->id_estado],
        [
            'estado' => $this->estado,
        ]);
        $this->limpiarCampos();
        
        $this->open=false;
        $this->emit('saved');

        //Para alerta de Editado
        if($this->verifiEdit == true){
            $this->emit('edit');
        }
        $this->verifiEdit=false;
    }

    public function editar($id){
        $estados = Estado::findOrFail($id);
        $this->id_estado = $id;
        $this->estado = $estados->estado;

        $this->open=true;
        $this->verifiEdit=true;
    }



    public function delete_item($id)
    {
        $data = Estado::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Error al eliminar datos" . $this->estado
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->estado . " Eliminado con éxito!"
        ]);
    }

    public function limpiarCampos(){
        $this->estado = '';


    }
}
