<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Inventario;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

use Maatwebsite\Excel\Excel;

class ReporteAlmacen extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];

    public function mount(){
        // Productos sin registro en la tabla 'inventario'
        $productosSinInventario = Producto::whereNotIn('id', Inventario::pluck('producto_id'))->get();

        // Productos con registro en la tabla 'inventario' pero con stock cero
        $productosConStockCero = Inventario::select('producto_id')
            ->selectRaw('SUM(cantidad_entrada) - SUM(cantidad_salida) as stock')
            ->groupBy('producto_id')
            ->havingRaw('stock = 0')
            ->get();

        // Aplicar la búsqueda si se ha proporcionado un término de búsqueda
        if (!empty($this->search)) {
        $productosSinInventario->where('id', 'like', '%' . $this->search . '%')
            ->orWhere('nombre_producto', 'like', '%' . $this->search . '%');

        $productosConStockCero->where('producto_id', 'like', '%' . $this->search . '%')
            ->orWhereHas('producto', function ($query) {
                $query->where('nombre_producto', 'like', '%' . $this->search . '%');
            });
        }

        // Crear una matriz de productos y sus detalles
        $this->productos = [];
        foreach ($productosSinInventario as $producto) {
            $this->productos[] = [
                'id' => $producto->codigo_producto,
                'nombre' => $producto->nombre_producto,
                'stock' => 0, // No hay stock porque no hay registro en inventario
            ];
        }
        foreach ($productosConStockCero as $producto) {
            $this->productos[] = [
                'id' => Producto::find($producto->producto_id)->codigo_producto,
                'nombre' => Producto::find($producto->producto_id)->nombre_producto,
                'stock' => 0, // Stock cero
            ];
        }
    }

    public function render()
    {
        
        return view('livewire.reporte-almacen');
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

    public function pdf (){

        //$this->imagePath = public_path('img/logo.png');

        $pdf = Pdf::loadView('pages.pdf.almacen');
        return $pdf->setPaper('A4')->stream('almacen.pdf');

    }

    public function Word(){
        try {
            // Cargar el template y procesar los datos
            $templatePath = storage_path('template.docx');
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);
            
            // Aquí puedes modificar el contenido del template si es necesario
            // Por ejemplo, reemplazar marcadores de posición con datos dinámicos
    
            // Guardar el documento generado
            $outputPath = storage_path('app/public/Document02.docx');
            $templateProcessor->saveAs($outputPath);
    
            // Devolver el archivo al cliente
            return response()->file($outputPath, [
                'Content-Disposition' => 'attachment; filename=almacen.docx; charset=iso-8859-1'
            ]);
        } catch (\Exception $e) {
            // Manejo de excepciones
            dd($e->getMessage());
        }

    }

    public function excel(){
        return \Excel::download('datos.xlsx');
    }
}
