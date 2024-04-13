<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Inventario;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteEntradas extends Component
{
    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    protected $listeners = [ "deleteItem" => "delete_item" , 'calcular'];
    
    public $fechaInicio;
    public $fechaFin;
    public $entradas, $fechaRango;
    public $pdf= null;

    public function mount(){
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

    public function pdf(){
        $productos = Producto::all();
        $entradas= Entrada::whereBetween('fecha_adquisicion', [$this->fechaInicio, $this->fechaFin])->get();

        // Filtra las entradas del almacén según el rango de fechas seleccionado
        $pdf = Pdf::loadView('pages.pdf.entradas', compact('entradas','productos'));
        return $pdf->setPaper('A4')->stream('entradas.pdf');

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

}
