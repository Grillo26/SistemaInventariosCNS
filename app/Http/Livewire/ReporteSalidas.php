<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Inventario;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class ReporteSalidas extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];
    
    public $fechaInicio;
    public $fechaFin;
    public $salidas, $fechaRango;

    public function mount(){
        $this->productos = Producto::all();
        $this->fechaInicio = Carbon::today()->subWeek(); // Establece la fecha de inicio por defecto
        $this->fechaFin = Carbon::today();
        $this->filtrarSalidas();
       
    }
    public function filtrarSalidas()
    {
        // Filtra las salidas del almacén según el rango de fechas seleccionado
        $this->salidas = Salida::whereBetween('fecha_salida', [$this->fechaInicio, $this->fechaFin])->get();
    }


    public function render()
    {
        
        return view('livewire.reporte-salidas');
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
        $salidas = Salida::whereBetween('fecha_salida', [$fechaInicio, $fechaFin])->get();
        // Filtra las salidas del almacén según el rango de fechas seleccionado
        $pdf = Pdf::loadView('pages.pdf.salidas', compact('salidas','productos'));
        return $pdf->setPaper('A4')->stream('salidas.pdf');

    }

    public function word(Request $request, $fechaInicio, $fechaFin){
        $productos = Producto::all();
        $salidas = Salida::whereBetween('fecha_salida', [$fechaInicio, $fechaFin])->get();
        
        // Crear una instancia de PhpWord
        $phpWord = new PhpWord();

        // Agregar una sección al documento
        $section = $phpWord->addSection();

        // Agregar el título al documento
        $section->addTitle('REPORTE DE SALIDAS DEL ALMACÉN');

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
        $table->addCell(2000, $headerCellStyle)->addText('Fecha de Salida');
        $table->addCell(2000, $headerCellStyle)->addText('Cantidad');

        // Iterar sobre las entradas y agregar cada una como una fila en la tabla
        foreach ($salidas as $salida) {
            $row = $table->addRow();
            $dataCellStyle = array(
                'borderSize' => 6,
                'borderColor' => '000000',
            );
            foreach ($productos as $producto) {
                if ($salida->producto_idProducto == $producto->id) {
                    $row->addCell(2000, $dataCellStyle)->addText($producto->codigo_producto);
                    $row->addCell(2000, $dataCellStyle)->addText($producto->nombre_producto);
                }
            }
            $row->addCell(2000, $dataCellStyle)->addText($salida->fecha_salida);
            $row->addCell(2000, $dataCellStyle)->addText($salida->cantidad);
        }

        // Guardar el documento
        $outputPath = storage_path('app/public/salidas_almacen.docx');
        $phpWord->save($outputPath);

        // Descargar el archivo
        return response()->download($outputPath)->deleteFileAfterSend(true);

    }

}
