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
use PhpOffice\PhpWord\Style\Font;


use Maatwebsite\Excel\Excel;


class ReporteAlmacen extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';
    public $productos;

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
        // Productos sin registro en la tabla 'inventario'
        $productosSinInventario = Producto::whereNotIn('id', Inventario::pluck('producto_id'))->get();

        // Productos con registro en la tabla 'inventario' pero con stock cero
        $productosConStockCero = Inventario::select('producto_id')
            ->selectRaw('SUM(cantidad_entrada) - SUM(cantidad_salida) as stock')
            ->groupBy('producto_id')
            ->havingRaw('stock = 0')
            ->get();

        // Crear una matriz de productos y sus detalles
        $productos = [];
        foreach ($productosSinInventario as $producto) {
            $productos[] = [
                'id' => $producto->codigo_producto,
                'nombre' => $producto->nombre_producto,
                'stock' => 0, // No hay stock porque no hay registro en inventario
            ];
        }
        foreach ($productosConStockCero as $producto) {
            $productos[] = [
                'id' => Producto::find($producto->producto_id)->codigo_producto,
                'nombre' => Producto::find($producto->producto_id)->nombre_producto,
                'stock' => 0, // Stock cero
            ];
        }

        $pdf = Pdf::loadView('pages.pdf.almacen',compact('productos'));
        return $pdf->setPaper('A4')->stream('almacen.pdf');

    }

    public function Word(){
        //$this->imagePath = public_path('img/logo.png');
        // Productos sin registro en la tabla 'inventario'
        $productosSinInventario = Producto::whereNotIn('id', Inventario::pluck('producto_id'))->get();

        // Productos con registro en la tabla 'inventario' pero con stock cero
        $productosConStockCero = Inventario::select('producto_id')
            ->selectRaw('SUM(cantidad_entrada) - SUM(cantidad_salida) as stock')
            ->groupBy('producto_id')
            ->havingRaw('stock = 0')
            ->get();

        // Crear una matriz de productos y sus detalles
        $productos = [];
        foreach ($productosSinInventario as $producto) {
            $productos[] = [
                'id' => $producto->codigo_producto,
                'nombre' => $producto->nombre_producto,
                'stock' => 0, // No hay stock porque no hay registro en inventario
            ];
        }
        foreach ($productosConStockCero as $producto) {
            $productos[] = [
                'id' => Producto::find($producto->producto_id)->codigo_producto,
                'nombre' => Producto::find($producto->producto_id)->nombre_producto,
                'stock' => 0, // Stock cero
            ];
        }
   
        // Crear un nuevo objeto de PHPWord
        $phpWord = new PhpWord();

        // Agregar una sección al documento
        $section = $phpWord->addSection();

        // Agregar un título al documento
        $section->addTitle('Lista de Productos', 1);

        // Agregar una tabla para mostrar los datos
        $table = $section->addTable();
        // Establecer ancho de la tabla para que ocupe toda la página
        $table->setWidth('100%');

        // Agregar encabezados de tabla con estilos
        $headerCellStyle = array(
            'borderSize' => 6,
            'borderColor' => '000000',
            'valign' => 'center',
        );
        $table->addRow();
        $table->addCell(2000, $headerCellStyle)->addText('Código del Producto');
        $table->addCell(2000, $headerCellStyle)->addText('Nombre del Producto');
        $table->addCell(2000, $headerCellStyle)->addText('Stock');

        // Iterar sobre los productos y agregar cada uno como una fila en la tabla
        foreach ($productos as $producto) {
            $table->addRow();
            // Establecer estilos para las celdas de datos
            $dataCellStyle = array(
                'borderSize' => 6,
                'borderColor' => '000000',
            );
            $table->addCell(2000, $dataCellStyle)->addText($producto['id']);
            $table->addCell(2000, $dataCellStyle)->addText($producto['nombre']);
            $table->addCell(2000, $dataCellStyle)->addText($producto['stock']);
        }

        // Guardar el documento
        $outputPath = storage_path('app/public/almacen.docx');
        $phpWord->save($outputPath);

        // Descargar el archivo
        return response()->download($outputPath)->deleteFileAfterSend(true);
    }

    public function excel(){
        return \Excel::download('datos.xlsx');
    }
}
