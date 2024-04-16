<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Inventario;
use App\Models\Proveedor;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class ReporteSinsalida extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';
    public $fechaInicio;
    public $fechaFin;
    public $salidas;


    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];

    public function mount(){
        $this->productos = Producto::all();
        $this->proveedores = Proveedor::all();
        /*$this->fechaInicio = Carbon::today()->subWeek(); // Establece la fecha de inicio por defecto
        $this->fechaFin = Carbon::today();
      
        $this->filtrarSalidas();*/
    }

    /*public function filtrarSalidas()
    {
        // Filtra las salidas del almacén según el rango de fechas seleccionado
        $this->salidas = Salida::whereBetween('fecha_salida', [$this->fechaInicio, $this->fechaFin])->get();
    }*/

    public function render()
    {
        
        $this->salidas = Inventario::select('producto_id', 'proveedor_idProveedor')
        ->selectRaw('SUM(cantidad_entrada) as cantidad_total')
        ->havingRaw('SUM(cantidad_salida) = 0')
        ->groupBy('producto_id', 'proveedor_idProveedor')
        ->get();

        return view('livewire.reporte-sinsalida');
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

    public function pdf(){

        $productos = Producto::all();
        $proveedores = Proveedor::all();
        $salidas = Inventario::select('producto_id', 'proveedor_idProveedor')
        ->selectRaw('SUM(cantidad_entrada) as cantidad_total')
        ->havingRaw('SUM(cantidad_salida) = 0')
        ->groupBy('producto_id', 'proveedor_idProveedor')
        ->get();

        $pdf = Pdf::loadView('pages.pdf.sinsalida', compact('productos','proveedores','salidas'));
        return $pdf->setPaper('A4')->stream('sinsalida.pdf');

    }

    public function word(){
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        $salidas = Inventario::select('producto_id', 'proveedor_idProveedor')
        ->selectRaw('SUM(cantidad_entrada) as cantidad_total')
        ->havingRaw('SUM(cantidad_salida) = 0')
        ->groupBy('producto_id', 'proveedor_idProveedor')
        ->get();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $section->addTitle('Reporte de Artículos si Salida del almacén', 1);
        // Agregar una tabla para mostrar los datos
        $table = $section->addTable();
        $table->setWidth('100%');
        // Agregar encabezados de tabla
        $headerCellStyle = array(
            'borderSize' => 6,
            'borderColor' => '000000',
            'valign' => 'center',
        );
        $table->addRow();
        $table->addCell(2000, $headerCellStyle)->addText('Código del Producto');
        $table->addCell(4000, $headerCellStyle)->addText('Nombre del Producto');
        $table->addCell(6000, $headerCellStyle)->addText('Nombre del Proveedor');
        $table->addCell(2000, $headerCellStyle)->addText('Cantidad Total');

        // Iterar sobre las salidas y agregar cada una como una fila en la tabla
        foreach ($salidas as $salida) {
            $producto = Producto::find($salida->producto_id);
            $proveedor = Proveedor::find($salida->proveedor_idProveedor);

            $table->addRow();
            // Establecer estilos para las celdas de datos
            $dataCellStyle = array(
                'borderSize' => 6,
                'borderColor' => '000000',
            );
            $table->addCell(2000, $dataCellStyle)->addText($producto->codigo_producto);
            $table->addCell(4000, $dataCellStyle)->addText($producto->nombre_producto);
            $table->addCell(6000, $dataCellStyle)->addText($proveedor->nombre_proveedor);
            $table->addCell(2000, $dataCellStyle)->addText($salida->cantidad_total);
        }

        // Guardar el documento
        $outputPath = storage_path('app/public/sinsalidas.docx');
        $phpWord->save($outputPath);

        // Descargar el archivo
        return response()->download($outputPath)->deleteFileAfterSend(true);

    }

}
