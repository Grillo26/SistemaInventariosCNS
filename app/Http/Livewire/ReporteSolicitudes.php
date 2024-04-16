<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Estado;
use App\Models\Solicitante;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

use Maatwebsite\Excel\Excel;

class ReporteSolicitudes extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';
    public $productos;
    public $solicitantes;
    public $solicitanteId;

    public $estadoSeleccionado=3;
    public $solicitudes;

    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];

    public function mount(){
        $this->estados = Estado::orderBy('id', 'asc')->get();  
        $this->productos = Producto::orderBy('id', 'asc')->get();  
        $this->users = User::orderBy('id', 'asc')->get(); 
        $this->solicitantes = Solicitante::orderBy('id', 'asc')->get();

    }

    public function render()
    {
        $this->solicitudes = [];
        // Filtrar las solicitudes según el estado seleccionado
        if ($this->estadoSeleccionado == 3) {
            $this->solicitantes = Solicitante::orderBy('id', 'asc')->get();
        }
        else{
            $this->solicitantes = Solicitante::where('estado_idEstado', $this->estadoSeleccionado)->get();
        }
        return view('livewire.reporte-solicitudes');
    }


    public function pdf ($estadoSeleccionado){

        $this->solicitudes = [];
        $estados = Estado::orderBy('id', 'asc')->get();  
        $productos = Producto::orderBy('id', 'asc')->get();  
        $users = User::orderBy('id', 'asc')->get(); 

        // Filtrar las solicitudes según el estado seleccionado
        if($estadoSeleccionado==3){
            $solicitantes = Solicitante::orderBy('id', 'asc')->get(); ;
        }
        else{
            $solicitantes = Solicitante::where('estado_idEstado', $estadoSeleccionado)->get();
        }

        $pdf = Pdf::loadView('pages.pdf.solicitudes', compact('solicitantes','productos','estados','users'));
        return $pdf->setPaper('A4')->stream('solicitudes.pdf');

    }

    public function pdfSelect ($solicitanteId){

        $this->solicitudes = [];
        $estados = Estado::orderBy('id', 'asc')->get();  
        $productos = Producto::orderBy('id', 'asc')->get();  
        $users = User::orderBy('id', 'asc')->get(); 
        $solicitudes = Solicitante::find($solicitanteId);

        $pdf = Pdf::loadView('pages.pdf.solicitudes', compact('solicitantes','productos','estados','users'));
        return $pdf->setPaper('A4')->stream('solicitudes.pdf');

    }

    public function Word($estadoSeleccionado){
        $this->solicitudes = [];
        $estados = Estado::orderBy('id', 'asc')->get();  
        $productos = Producto::orderBy('id', 'asc')->get();  
        $users = User::orderBy('id', 'asc')->get(); 

        // Filtrar las solicitudes según el estado seleccionado
        if($estadoSeleccionado==3){
            $solicitantes = Solicitante::orderBy('id', 'asc')->get(); ;
        }
        else{
            $solicitantes = Solicitante::where('estado_idEstado', $estadoSeleccionado)->get();
        }

        // Crear un nuevo documento de Word
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $section->addTitle('Reporte de Solicitudes', 1);

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
        $table->addCell(4000, $headerCellStyle)->addText('Referencia');
        $table->addCell(3000, $headerCellStyle)->addText('Detalle');
        $table->addCell(2000, $headerCellStyle)->addText('Cantidad');
        $table->addCell(2000, $headerCellStyle)->addText('Código Producto');
        $table->addCell(3000, $headerCellStyle)->addText('Nombre Producto');
        $table->addCell(2000, $headerCellStyle)->addText('Usuario');
        $table->addCell(2000, $headerCellStyle)->addText('Estado');

        // Iterar sobre las solicitudes y agregar cada una como una fila en la tabla
        foreach ($solicitantes as $solicitante) {
            $table->addRow();
            $dataCellStyle = array(
                'borderSize' => 6,
                'borderColor' => '000000',
            );
            // Obtener los datos necesarios de la solicitud y agregarlos como celdas
            $detalle = $solicitante->detalle;
            $cantidad = $solicitante->cantidad;
            foreach($productos as $producto){
                if($solicitante->producto_idProducto == $producto->id){
                    $codigoProducto = $producto->codigo_producto;
                    $nombreProducto = $producto->nombre_producto;
                }
            }

            foreach($users as $user){
                if($solicitante->user_id == $user->id){
                    $nombreUsuario = $user->name;
                }
            }

            foreach($estados as $est){
                if($solicitante->estado_idEstado == $est->id){
                    $estado = $est->estado;
                }
            }

            $table->addCell(4000, $dataCellStyle)->addText($solicitante->referencia);
            $table->addCell(3000, $dataCellStyle)->addText($detalle);
            $table->addCell(2000, $dataCellStyle)->addText($cantidad);
            $table->addCell(2000, $dataCellStyle)->addText($codigoProducto);
            $table->addCell(3000, $dataCellStyle)->addText($nombreProducto);
            $table->addCell(2000, $dataCellStyle)->addText($nombreUsuario);
            $table->addCell(2000, $dataCellStyle)->addText($estado);
        }

        // Guardar el documento
        $outputPath = storage_path('app/public/solicitudes.docx');
        $phpWord->save($outputPath);

        // Descargar el archivo
        return response()->download($outputPath)->deleteFileAfterSend(true);
        
    }

    public function excel(){
        return \Excel::download('datos.xlsx');
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
}
