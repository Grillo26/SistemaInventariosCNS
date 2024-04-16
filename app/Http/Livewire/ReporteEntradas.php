<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Carbon\Carbon;
use Livewire\Component;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Style\Font;

class ReporteEntradas extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    
    public $fechaInicio;
    public $fechaFin;
    public $entradas, $fechaRango;


    public function mount(){
        $this->entradas = null;
        $this->productos = Producto::all();
        $this->fechaInicio = Carbon::today()->subWeek(); // Establece la fecha de inicio por defecto
        $this->fechaFin = Carbon::today();
        $this->filtrarEntradas();
       
    }
    public function filtrarEntradas()
    {
        // Filtra las salidas del almacén según el rango de fechas seleccionado
        $this->entradas = Entrada::whereBetween('fecha_adquisicion', [$this->fechaInicio, $this->fechaFin])->get();
    }

    public function render()
    {
        
        return view('livewire.reporte-entradas');
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

    public function pdf(Request $request, $fechaInicio, $fechaFin){
        $productos = Producto::all();
        $entradas = Entrada::whereBetween('fecha_adquisicion', [$fechaInicio, $fechaFin])->get();
        // Filtra las entradas del almacén según el rango de fechas seleccionado
        $pdf = Pdf::loadView('pages.pdf.entradas', compact('entradas','productos'));
        return $pdf->setPaper('A4')->stream('entradas.pdf');

    }

    public function word(Request $request, $fechaInicio, $fechaFin){
        
        $productos = Producto::all();
        $entradas = Entrada::whereBetween('fecha_adquisicion', [$fechaInicio, $fechaFin])->get();

        // Crear una instancia de PhpWord
        $phpWord = new PhpWord();

        // Agregar una sección al documento
        $section = $phpWord->addSection();

        // Agregar el título al documento
        $section->addTitle('REPORTE DE ENTRADAS AL ALMACÉN');

        // Agregar una tabla para mostrar los datos de las entradas
        $table = $section->addTable();
        $table->setWidth('100%');
        // Agregar encabezados de tabla con estilos
        $headerCellStyle = array(
            'borderSize' => 6,
            'borderColor' => '000000',
            'valign' => 'center',
        );

        $table->addRow();
        $table->addCell(2000, $headerCellStyle)->addText('Código Producto');
        $table->addCell(2000, $headerCellStyle)->addText('Nombre Producto');
        $table->addCell(2000, $headerCellStyle)->addText('Fecha de Ingreso');
        $table->addCell(2000, $headerCellStyle)->addText('Cantidad');

        // Iterar sobre las entradas y agregar cada una como una fila en la tabla
        foreach ($entradas as $entrada) {
            $row = $table->addRow();
            $dataCellStyle = array(
                'borderSize' => 6,
                'borderColor' => '000000',
            );
            foreach ($productos as $producto) {
                if ($entrada->producto_idProducto == $producto->id) {
                    $row->addCell(2000, $dataCellStyle)->addText($producto->codigo_producto);
                    $row->addCell(2000, $dataCellStyle)->addText($producto->nombre_producto);
                }
            }
            $row->addCell(2000, $dataCellStyle)->addText($entrada->fecha_adquisicion);
            $row->addCell(2000, $dataCellStyle)->addText($entrada->cantidad);
        }

        // Guardar el documento
        $outputPath = storage_path('app/public/entradas_almacen.docx');
        $phpWord->save($outputPath);

        // Descargar el archivo
        return response()->download($outputPath)->deleteFileAfterSend(true);

    }

    public function comp($id){
        $user = auth()->user();
        $fechaActual = now();
        $productos = Producto::all();
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();

        $data = Entrada::find($id);

        foreach($productos as $producto){
            if($data['producto_idProducto'] == $producto->id){
                $codigo_producto = $producto->codigo_producto;
                $nombre_producto = $producto->nombre_producto;
            }
            foreach($categorias as $categoria){
                if($producto->categoria_idCategoria == $categoria->id){
                    $categoria = $categoria->nombre_categoria;
                }
            }
            foreach($subcategorias as $subcategoria){
                if($producto->subcategoria_idSubcategoria == $subcategoria->id){
                    $subcategoria = $subcategoria->nombre_subcategoria;
                }
            }
        }
        $descripcion = $data['descripcion'];
        $fecha_adquisicion = $data['fecha_adquisicion'];
        $fecha_caducidad = $data['fecha_caducidad'];
        $cantidad = $data['cantidad'];

        try {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(Storage_path('templateingreso.docx'));
            $templateProcessor->setValue('name',$user);
            $templateProcessor->setValue('date_now',$fechaActual);
            $templateProcessor->setValue('desc',$descripcion);
            $templateProcessor->setValue('codigo_producto',$codigo_producto);
            $templateProcessor->setValue('nombre_producto',$nombre_producto);
            $templateProcessor->setValue('cate',$categoria);
            $templateProcessor->setValue('subcate',$subcategoria);
            $templateProcessor->setValue('date',$fecha_adquisicion);
            $templateProcessor->setValue('venc',$fecha_caducidad);
            $templateProcessor->setValue('cantidad',$cantidad);
            
            // Guardar el documento Word generado
            $outputPath = storage_path('app/public/documento_generado.docx');
            $templateProcessor->saveAs($outputPath);

            // Descargar el archivo
            return response()->download($outputPath)->deleteFileAfterSend(true);
        }
        catch (\Exception $e) {
            // Manejo de excepciones
            dd($e->getMessage());
        }
    }

}
