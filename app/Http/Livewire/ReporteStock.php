<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Inventario;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Carbon\Carbon;
use Livewire\Component;

use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class ReporteStock extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    public $buscar;

    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];

    public function mount(){
        $this->productos = Producto::all();
        $this->proveedores = Proveedor::all();
        $this->categorias = Categoria::all();
        $this->subcategorias = Subcategoria::all();
        
    }

    public function render()
    {
        $this->stock = Inventario::select('producto_id', 'proveedor_idProveedor')
            ->whereHas('productos', function ($query) {
                $query->where('codigo_producto', 'like', '%' . $this->search . '%')
                ->orWhere('nombre_producto', 'like', '%' . $this->search . '%');
            })

            ->orwhere('proveedor_idProveedor', 'like', '%' . $this->search . '%')  
            ->selectRaw('SUM(cantidad_entrada) - SUM(cantidad_salida) as cantidad')
            ->groupBy('producto_id', 'proveedor_idProveedor')
            ->orderBy($this->sort, $this->direction)
            ->get();
        return view('livewire.reporte-stock');
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

    public function pdf($search){

        $this->buscar= $search;
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();

        $stock = Inventario::select('producto_id', 'proveedor_idProveedor')
            ->whereHas('productos', function ($query) {
                $query->where('codigo_producto', 'like', '%' . $this->buscar . '%')
                ->orWhere('nombre_producto', 'like', '%' . $this->buscar . '%');
            })

            ->orwhere('proveedor_idProveedor', 'like', '%' . $this->buscar . '%')  
            ->selectRaw('SUM(cantidad_entrada) - SUM(cantidad_salida) as cantidad')
            ->groupBy('producto_id', 'proveedor_idProveedor')
            ->orderBy($this->sort, $this->direction)
            ->get();

        $pdf = Pdf::loadView('pages.pdf.stock', compact('productos','proveedores','stock','categorias','subcategorias'));
        return $pdf->setPaper('A4')->stream('stock.pdf');
    }

    public function pdfall(){

        $productos = Producto::all();
        $proveedores = Proveedor::all();
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        $stock = Inventario::select('producto_id', 'proveedor_idProveedor')
            ->whereHas('productos', function ($query) {
                $query->where('codigo_producto', 'like', '%' . $this->search . '%')
                ->orWhere('nombre_producto', 'like', '%' . $this->search . '%');
            })

            ->orwhere('proveedor_idProveedor', 'like', '%' . $this->search . '%')  
            ->selectRaw('SUM(cantidad_entrada) - SUM(cantidad_salida) as cantidad')
            ->groupBy('producto_id', 'proveedor_idProveedor')
            ->orderBy($this->sort, $this->direction)
            ->get();
        $pdf = Pdf::loadView('pages.pdf.stock', compact('productos','proveedores','stock','categorias','subcategorias'));
        return $pdf->setPaper('A4')->stream('stock.pdf');
    }

}
