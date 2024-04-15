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
