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
use PhpOffice\PhpWord\Style\Cell;
use PhpOffice\PhpWord\Style\Table;

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

    public function word($search){

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
        
            // Crear una instancia de PhpWord
            $phpWord = new PhpWord();

            // Agregar una sección al documento
            $section = $phpWord->addSection();

            // Agregar un título al documento
            $section->addTitle('Reporte de Stock', 1);

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
            $table->addCell(2000, $headerCellStyle)->addText('Categoría');
            $table->addCell(2000, $headerCellStyle)->addText('Subcategoría');
            $table->addCell(2000, $headerCellStyle)->addText('Cantidad');

            // Iterar sobre los datos y agregar cada uno como una fila en la tabla
            foreach ($stock as $item) {
                $table->addRow();
                // Obtener el producto correspondiente
                $producto = $productos->where('id', $item->producto_id)->first();
                // Obtener la categoría correspondiente
                $categoria = $categorias->where('id', $producto->categoria_idCategoria)->first();
                // Obtener la subcategoría correspondiente
                $subcategoria = $subcategorias->where('id', $producto->subcategoria_idSubcategoria)->first();
                // Establecer estilos para las celdas de datos
                $dataCellStyle = array(
                    'borderSize' => 6,
                    'borderColor' => '000000',
                );
                $table->addCell(2000, $dataCellStyle)->addText($producto->codigo_producto);
                $table->addCell(2000, $dataCellStyle)->addText($producto->nombre_producto);
                $table->addCell(2000, $dataCellStyle)->addText($categoria->nombre_categoria);
                $table->addCell(2000, $dataCellStyle)->addText($subcategoria->nombre_subcategoria);
                $table->addCell(2000, $dataCellStyle)->addText($item->cantidad);
            }

            // Guardar el documento
            $outputPath = storage_path('app/public/documento.docx');
            $phpWord->save($outputPath);

            // Descargar el archivo
            return response()->download($outputPath)->deleteFileAfterSend(true);
        

    }

    public function wordall(){
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
        
            // Crear una instancia de PhpWord
            $phpWord = new PhpWord();

            // Agregar una sección al documento
            $section = $phpWord->addSection();

            // Agregar un título al documento
            $section->addTitle('Reporte de Stock', 1);

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
            $table->addCell(2000, $headerCellStyle)->addText('Categoría');
            $table->addCell(2000, $headerCellStyle)->addText('Subcategoría');
            $table->addCell(2000, $headerCellStyle)->addText('Cantidad');

            // Iterar sobre los datos y agregar cada uno como una fila en la tabla
            foreach ($stock as $item) {
                $table->addRow();
                // Obtener el producto correspondiente
                $producto = $productos->where('id', $item->producto_id)->first();
                // Obtener la categoría correspondiente
                $categoria = $categorias->where('id', $producto->categoria_idCategoria)->first();
                // Obtener la subcategoría correspondiente
                $subcategoria = $subcategorias->where('id', $producto->subcategoria_idSubcategoria)->first();
                // Establecer estilos para las celdas de datos
                $dataCellStyle = array(
                    'borderSize' => 6,
                    'borderColor' => '000000',
                );
                $table->addCell(2000, $dataCellStyle)->addText($producto->codigo_producto);
                $table->addCell(2000, $dataCellStyle)->addText($producto->nombre_producto);
                $table->addCell(2000, $dataCellStyle)->addText($categoria->nombre_categoria);
                $table->addCell(2000, $dataCellStyle)->addText($subcategoria->nombre_subcategoria);
                $table->addCell(2000, $dataCellStyle)->addText($item->cantidad);
            }

            // Guardar el documento
            $outputPath = storage_path('app/public/documento.docx');
            $phpWord->save($outputPath);

            // Descargar el archivo
            return response()->download($outputPath)->deleteFileAfterSend(true);

    }

}
