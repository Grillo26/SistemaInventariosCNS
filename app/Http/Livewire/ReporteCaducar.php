<?php

namespace App\Http\Livewire;
use App\Models\Entrada;
use App\Models\Producto;
use App\Models\Proveedor;
use Carbon\Carbon;
use Livewire\Component;

use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class ReporteCaducar extends Component
{

    //Definicion de variables
    public $search="";
    public $sort='id'; 
    public $direction ='desc';

    public function mount(){
        $this->productos = Producto::all();
    }

    public function render()
    {
       // Obtener artículos próximos a caducar
       $articulosCaducar = Entrada::whereDate('fecha_caducidad', '<', Carbon::now())
        ->orWhereHas('productos', function($query) { 
            $query->where('codigo_producto', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('productos', function($query) {
            $query->where('nombre_producto', 'like', '%' . $this->search . '%');
        })  
        ->orwhere('fecha_caducidad', 'like', '%' . $this->search . '%')    
         // Eliminado el uso de '%'
        ->orderBy($this->sort, $this->direction)
        ->get();

    return view('livewire.reporte-caducar', ['articulosCaducar' => $articulosCaducar]);

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
        $user = auth()->user();
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        // Obtener artículos próximos a caducar
        $articulosCaducar = Entrada::whereDate('fecha_caducidad', '<', Carbon::now())
       ->orWhereHas('productos', function($query) { 
           $query->where('codigo_producto', 'like', '%' . $this->search . '%');
       })
       ->orWhereHas('productos', function($query) {
           $query->where('nombre_producto', 'like', '%' . $this->search . '%');
       })  
       ->orwhere('fecha_caducidad', 'like', '%' . $this->search . '%')    
        // Eliminado el uso de '%'
       ->orderBy($this->sort, $this->direction)
       ->get();
       $this->imagePath = public_path('img/encabezado.png');

       
        $pdf = Pdf::loadView('pages.pdf.caducar', compact('articulosCaducar','user','productos','proveedores'),['imagePath' => $this->imagePath]);
        return $pdf->setPaper('A4')->stream('caducar.pdf');
    }

    public function word(){
        $productos = Producto::all();
        // Obtener artículos próximos a caducar
        $articulosCaducar = Entrada::whereDate('fecha_caducidad', '<', Carbon::now())
       ->orWhereHas('productos', function($query) { 
           $query->where('codigo_producto', 'like', '%' . $this->search . '%');
       })
       ->orWhereHas('productos', function($query) {
           $query->where('nombre_producto', 'like', '%' . $this->search . '%');
       })  
       ->orwhere('fecha_caducidad', 'like', '%' . $this->search . '%')    
        // Eliminado el uso de '%'
       ->orderBy($this->sort, $this->direction)
       ->get();
        // Crear un nuevo documento de Word
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Agregar un título al documento
        $section->addTitle('Reporte de Artículos Vencido o Pronto a Caducar', 1);

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
        $table->addCell(2000, $headerCellStyle)->addText('Días Restantes');
        $table->addCell(3000, $headerCellStyle)->addText('Fecha de Caducidad');

        // Iterar sobre los productos y agregar cada uno como una fila en la tabla
        foreach ($articulosCaducar as $articulo) {
            $producto = $productos->where('id', $articulo->producto_idProducto)->first();
            $fechaCaducidad = \Carbon\Carbon::parse($articulo->fecha_caducidad);
            $hoy = \Carbon\Carbon::now();
            $diasRestantes = $hoy->diffInDays($fechaCaducidad, false); // false para contar solo días futuros

            $table->addRow();
            // Establecer estilos para las celdas de datos
            $dataCellStyle = array(
                'borderSize' => 6,
                'borderColor' => '000000',
            );
            $table->addCell(2000, $dataCellStyle)->addText($producto->codigo_producto);
            $table->addCell(4000, $dataCellStyle)->addText($producto->nombre_producto);
            $table->addCell(2000, $dataCellStyle)->addText($diasRestantes < 0 ? 'Artículo vencido' : $diasRestantes . ' días');
            $table->addCell(3000, $dataCellStyle)->addText($articulo->fecha_caducidad);
        }

        // Guardar el documento
        $outputPath = storage_path('app/public/articulos_caducados.docx');
        $phpWord->save($outputPath);

        // Descargar el archivo
        return response()->download($outputPath)->deleteFileAfterSend(true);
        
    }

}
 