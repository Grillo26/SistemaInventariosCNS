<?php

namespace App\Http\Livewire;
use App\Models\Inventario; 
use App\Models\Producto; 
use App\Models\Proveedor; 

use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

use PhpOffice\PhpWord\Style\Font;


use Livewire\Component;

class Kardex extends Component
{
    public $productoId;
    public $kardex;
    public $nombre_producto=" ";
    public $proveedores;
    public $cantidad = 0;

    public function render()
    {
        $productos = Producto::all();
        return view('livewire.kardex', ['productos' => $productos]);
    }
    

    public function mount()
    {
        // Inicializar el ID del producto seleccionado
        $this->productoId = null;
        $this->kardex = [];
    }

    public function mostrarKardex()
    {
        $this->proveedores = Proveedor::orderBy('id', 'asc')->get();   
        $producto = Producto::find($this->productoId);
        $this->nombre_producto = Producto::find($this->productoId)->nombre_producto;
        
        if ($producto) {
            $this->kardex = Inventario::where('producto_id', $this->productoId)
                ->orderBy('created_at')
                ->get();
                $this->cantidad = Inventario::where('producto_id', $this->productoId)
                ->sum('cantidad_entrada') - Inventario::where('producto_id', $this->productoId)
                ->sum('cantidad_salida');
        }
    }

    public function updatedProductoId()
    {
        if ($this->productoId) {
            $this->mostrarKardex();
        }
    }

    public function pdf($productoId){

        $proveedores = Proveedor::orderBy('id', 'asc')->get();   
        $nombreProducto = Producto::find($productoId)->nombre_producto;
        // Obtener el kardex para el producto seleccionado
        $kardex = Inventario::where('producto_id', $productoId)
        ->orderBy('created_at')
        ->get();
        $cantidad = Inventario::where('producto_id', $productoId)
                ->sum('cantidad_entrada') - Inventario::where('producto_id', $productoId)
                ->sum('cantidad_salida');


        $this->imagePath = public_path('img/cns.png');

        
        $pdf = Pdf::loadView('pages.pdf.kardex', compact('nombreProducto','kardex','cantidad','proveedores'),['imagePath' => $this->imagePath]);
        return $pdf->setPaper('A4')->stream('kardex.pdf');

    }

    public function word($productoId){

        $proveedores = Proveedor::orderBy('id', 'asc')->get();   
        $nombreProducto = Producto::find($productoId)->nombre_producto;
        // Obtener el kardex para el producto seleccionado
        $kardex = Inventario::where('producto_id', $productoId)
        ->orderBy('created_at')
        ->get();
        $cantidad = Inventario::where('producto_id', $productoId)
                ->sum('cantidad_entrada') - Inventario::where('producto_id', $productoId)
                ->sum('cantidad_salida');

        // Crear una instancia de PhpWord
        $phpWord = new PhpWord();

        // Agregar una sección al documento
        $section = $phpWord->addSection();

        // Agregar un título al documento
        $section->addTitle('Kardex de Producto', 1);

        // Agregar el nombre del artículo y la cantidad total en stock
        $section->addText('Nombre del Artículo: ' . $nombreProducto);
        $section->addText('Total Cantidad en Stock: ' . $cantidad);

        // Agregar encabezados de tabla con estilos
        $headerCellStyle = array(
            'borderSize' => 6,
            'borderColor' => '000000',
            'valign' => 'center',
        );

        // Agregar una tabla para mostrar los datos del kardex
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(2000,  $headerCellStyle)->addText('Fecha');
        $table->addCell(2000,  $headerCellStyle)->addText('Hora');
        $table->addCell(2000,  $headerCellStyle)->addText('Proveedor');
        $table->addCell(2000,  $headerCellStyle)->addText('Entrada');
        $table->addCell(2000,  $headerCellStyle)->addText('Salida');
        $table->addCell(2000,  $headerCellStyle)->addText('Cantidad');
        $table->addCell(2000,  $headerCellStyle)->addText('Observación');

        // Iterar sobre los registros del kardex y agregar cada uno como una fila en la tabla
        $saldoAcumulado = 0;
        foreach ($kardex as $registro) {
            $row = $table->addRow();
            $dataCellStyle = array(
                'borderSize' => 6,
                'borderColor' => '000000',
            );
            $row->addCell(2000, $dataCellStyle)->addText($registro->fecha);
            $row->addCell(2000, $dataCellStyle)->addText($registro->hora);
            foreach ($proveedores as $proveedor) {
                if ($registro->proveedor_idProveedor == $proveedor->id) {
                    $row->addCell(2000, $dataCellStyle)->addText($proveedor->nombre_proveedor);
                }
            }
    

            $row->addCell(2000, $dataCellStyle)->addText($registro->cantidad_entrada);
            $row->addCell(2000, $dataCellStyle)->addText($registro->cantidad_salida);
            $saldoAcumulado += $registro->cantidad_entrada - $registro->cantidad_salida;
            $row->addCell(2000, $dataCellStyle)->addText($saldoAcumulado);
            $row->addCell(2000, $dataCellStyle)->addText($registro->obs);
        }


        // Guardar el documento
        $outputPath = storage_path('app/public/kardex.docx');
        $phpWord->save($outputPath);

        // Descargar el archivo
        return response()->download($outputPath)->deleteFileAfterSend(true);

    }
} 
