<?php

namespace App\Http\Livewire;
use App\Models\CompraProducto;
use App\Models\Grupo;
use App\Models\Cuenta;
use App\Models\Unidad;

use Livewire\Component;

class Entradas extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    public $open = false;
    public $verifiEdit = false;

    public $fecha_compra, $horac, $total, $ady, $proveedor_idProveedor, $id_entrada;
    protected $listeners = [ "deleteItem" => "delete_item" ];
    
    public function render(){
        $entradas = CompraProducto::where('id', 'like', '%' . $this->search . '%')
        ->orwhere('fecha_compra', 'like', '%' . $this->search . '%')
        ->orwhere('horac', 'like', '%' . $this->search . '%')
        ->orwhere('total', 'like', '%' . $this->search . '%')
        ->orwhere('ady', 'like', '%' . $this->search . '%')
        ->orwhere('proveedor_idProveedor', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->get();
        $grupos = Grupo::where('id', 'like', '%' . $this->search . '%')
        ->orwhere('nombre_grupo', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->get();
        $unidades = Unidad::where('id', 'like', '%' . $this->search . '%')
        ->orwhere('nombre_unidad', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->get();
        $cuentas = Cuenta::where('id', 'like', '%' . $this->search . '%')
        ->orwhere('nombre_cuenta', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->get();

        return view('livewire.entradas', compact ('entradas','grupos','cuentas','unidades'));
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
        CompraProducto::updateOrCreate(['id'=>$this->id_entrada],
        [
            'fecha__compra' => $this->fecha_compra,
            'horac' => $this->horac,
            'total' => $this->total,
            'ady' => $this->ady,
            'proveedor_idProveedor' => $this->proveedor_idProveedor
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
        $entrada = CompraProducto::findOrFail($id);
        $this->id_entrada = $id;
        $this->fecha_compra = $entrada->fecha_compra;
        $this->horac = $entrada->horac;
        $this->total = $entrada->total;
        $this->ady = $entrada->ady;
        $this->proveedor_idProveedor = $entrada->proveedor_idProveedor;
        $this->open=true;
        $this->verifiEdit=true;
    }



    public function delete_item($id)
    {
        $data = CompraProducto::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Error al eliminar datos" . $this->id_entrada
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->id_entrada . " Eliminado con éxito!"
        ]);
    }

    public function limpiarCampos(){
        $this->id_entrada = '';
        $this->fecha_compra = '';
        $this->horac = '';
        $this->total ='';
        $this->ady = '';
        $this->proveedor_idProveedor ='';


    }
}
