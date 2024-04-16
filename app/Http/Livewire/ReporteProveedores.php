<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Proveedor;
use Carbon\Carbon;
use Livewire\Component;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Style\Font;



class ReporteProveedores extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];
    
    public function mount(){
        $this->productos = Producto::all();
        $this->proveedores = Proveedor::all();
       
    }

    public function render()
    {
        
        return view('livewire.reporte-proveedores');
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
        $pdf = Pdf::loadView('pages.pdf.proveedores', compact('proveedores','productos'));
        return $pdf->setPaper('A4')->stream('proveedores.pdf');

    }

    public function word(){
        $proveedores = Proveedor::all();
        // Crear un nuevo documento de Word
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        // Agregar un título al documento
        $section->addTitle('Lista de Proveedores', 1);

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
        $table->addCell(4000, $headerCellStyle)->addText('Nombre del Proveedor');
        $table->addCell(3000, $headerCellStyle)->addText('Teléfono');
        $table->addCell(4000, $headerCellStyle)->addText('Email');

        // Iterar sobre los proveedores y agregar cada uno como una fila en la tabla
        foreach ($proveedores as $proveedor) {
            $table->addRow();
            // Establecer estilos para las celdas de datos
            $dataCellStyle = array(
                'borderSize' => 6,
                'borderColor' => '000000',
            );
            $table->addCell(4000, $dataCellStyle)->addText($proveedor->nombre_proveedor);
            $table->addCell(3000, $dataCellStyle)->addText($proveedor->n_telefono);
            $table->addCell(4000, $dataCellStyle)->addText($proveedor->email);
        }

        // Guardar el documento
        $outputPath = storage_path('app/public/proveedores.docx');
        $phpWord->save($outputPath);

        // Descargar el archivo
        return response()->download($outputPath)->deleteFileAfterSend(true);

    }

}
