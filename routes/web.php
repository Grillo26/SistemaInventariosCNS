<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\PasilloController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\DllController;
use App\Http\Controllers\SolicitanteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EstanteController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

use App\Http\livewire\Productos;
use App\Http\livewire\Cuentas;
use App\Http\livewire\Salidas;
use App\Http\livewire\Unidades;
use App\Http\livewire\Entradas;
use App\Http\livewire\Stock;
use App\Http\livewire\Ubicacion;
use App\Http\livewire\Comprobate;
use App\Http\livewire\Estad;
use App\Http\livewire\Mesa;
use App\Http\livewire\Dashboard;
use App\Http\livewire\Reporte;
use App\Http\livewire\ReporteAlmacen;
use App\Http\livewire\ReporteEntradas;
use App\Http\livewire\ReporteSalidas;
use App\Http\livewire\Kardex;
use App\Http\livewire\ReporteCaducar;
use App\Http\livewire\ReporteStock;
use App\Http\livewire\ReporteSinsalida;
use App\Http\livewire\ReporteProveedores;
use App\Http\livewire\ReporteSolicitudes;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/  

Route::get('/', function () {
    return view('auth.login');
});

Route::group([ "middleware" => ['auth:sanctum', 'verified'] ], function() {
    //Route::view('/dashboard', "dashboard")->name('dashboard');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');


    Route::get('/user', [ UserController::class, "index_view" ])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');

    Route::get('/grupos', [ GrupoController::class, "index_view" ])->name('grupos');
    Route::view('/grupos/new', "pages.grupo.grupo-new")->name('grupos.new');
    Route::view('/grupos/edit/{grupoId}', "pages.grupo.grupo-edit")->name('grupos.edit');

    Route::get('/cuentas', [ CuentaController::class, "index_view" ])->name('cuentas');
    Route::view('/cuentas/new', "pages.cuenta.cuenta-new")->name('cuentas.new');
    Route::view('/cuentas/edit/{cuentaId}', "pages.cuenta.cuenta-edit")->name('cuentas.edit');

    Route::get('/unidades', [ UnidadController::class, "index_view" ])->name('unidades');
    Route::view('/unidades/new', "pages.unidad.unidad-new")->name('unidades.new');
    Route::view('/unidades/edit/{unidadId}', "pages.unidad.unidad-edit")->name('unidades.edit');

    Route::get('/mesas', [ MesaController::class, "index_view" ])->name('mesas');
    Route::view('/mesas/new', "pages.mesa.mesa-new")->name('mesas.new');
    Route::view('/mesas/edit/{mesaId}', "pages.mesa.mesa-edit")->name('mesas.edit');

    Route::get('/estantes', [ EstanteController::class, "index_view" ])->name('estantes');
    Route::view('/estantes/new', "pages.estante.estante-new")->name('estantes.new');
    Route::view('/estantes/edit/{estanteId}', "pages.estante.estante-edit")->name('estantes.edit');

    Route::get('/pasillos', [ PasilloController::class, "index_view" ])->name('pasillos');
    Route::view('/pasillos/new', "pages.pasillo.pasillo-new")->name('pasillos.new');
    Route::view('/pasillos/edit/{pasilloId}', "pages.pasillo.pasillo-edit")->name('pasillos.edit');
    
    Route::get('/proveedor', [ ProveedorController::class, "index_view" ])->name('proveedor');
    Route::view('/proveedor/new', "pages.proveedor.proveedor-new")->name('proveedor.new');
    Route::view('/proveedor/edit/{proveedorId}', "pages.proveedor.proveedor-edit")->name('proveedor.edit');

    Route::get('/dll', [ DllController::class, "index_view" ])->name('dll');
    Route::view('/dll/new', "pages.dll.dll-new")->name('dll.new');
    Route::view('/dll/edit/{dllId}', "pages.dll.dll-edit")->name('dll.edit');

    Route::get('/solicitante', [ SolicitanteController::class, "index_view" ])->name('solicitante');
    Route::view('/solicitante/new', "pages.solicitante.solicitante-new")->name('solicitante.new');
    Route::view('/solicitante/edit/{solicitanteId}', "pages.solicitante.solicitante-edit")->name('solicitante.edit');

    Route::get('/producto', [ ProductoController::class, "index_view" ])->name('producto');
    Route::view('/producto/new', "pages.producto.producto-new")->name('producto.new');
    Route::view('/producto/edit/{productoId}', "pages.producto.producto-edit")->name('producto.edit');

    Route::get('/kardex', [ KardexController::class, "index_view" ])->name('kardex');

    Route::get('salidas', Salidas::class)->name('salidas');

    Route::get('entradas', Entradas::class)->name('entradas');

    Route::get('stock', Stock::class)->name('stock');

    Route::get('ubicacion', Ubicacion::class)->name('ubicacion');
    
    Route::get('comprobantes', Comprobate::class)->name('comprobantes');

    Route::get('estados', Estad::class)->name('estados');

    Route::get('reporte', Reporte::class)->name('reporte');
    Route::get('reporte/vencimiento', [Reporte::class, 'vencimiento'])->name('reporte.vencimiento');
    Route::get('reporte/stock', [Reporte::class, 'stock'])->name('reporte.stock');
    Route::get('reporte/sinsalida', [Reporte::class, 'sinsalida'])->name('reporte.sinsalida');
    Route::get('reporte/almacen', [Reporte::class, 'almacen'])->name('reporte.almacen');
    Route::get('reporte/entradas', [Reporte::class, 'entradas'])->name('reporte.entradas');
    Route::get('reporte/salidas', [Reporte::class, 'salidas'])->name('reporte.salidas');
    Route::get('reporte/proveedores', [Reporte::class, 'proveedores'])->name('reporte.proveedores');
    Route::get('reporte/solicitudes', [Reporte::class, 'solicitudes'])->name('reporte.solicitudes');

    Route::post('entradas/reporteFecha', [PDFController::class, 'generarPDFfechaEntrada'])->name('entradas.fecha');
    Route::post('salidas/reporteFecha', [PDFController::class, 'generarPDFfechaSalida'])->name('salidas.fecha');

    Route::get('/reporte/almacen/pdf', [ ReporteAlmacen::class, 'pdf' ])->name('almacen.pdf');
    Route::get('/reporte/almacen/word', [ ReporteAlmacen::class, 'word' ])->name('almacen.word');
    Route::get('/reporte/almacen/excel', [ ReporteAlmacen::class, 'excel' ])->name('almacen.excel');

    Route::get('/reporte/articulos/pdf', [ Reporte::class, 'articulopdf' ])->name('articulos.pdf');

    Route::get('/reporte/entradas/pdf/{fechaInicio}/{fechaFin}', [ReporteEntradas::class, 'pdf'])->name('entradas.pdf');
    Route::get('/reporte/entradas/word/{fechaInicio}/{fechaFin}', [ReporteEntradas::class, 'word'])->name('entradas.word');
    Route::get('/reporte/entrada/word/{id}', [ReporteEntradas::class, 'comp'])->name('comp.word');
    
    Route::get('/reporte/salidas/pdf/{fechaInicio}/{fechaFin}', [ReporteSalidas::class, 'pdf'])->name('salidas.pdf');
    Route::get('/reporte/salidas/word/{fechaInicio}/{fechaFin}', [ReporteSalidas::class, 'word'])->name('salidas.word');

    Route::get('/reporte/caducar/pdf/', [ ReporteCaducar::class, 'pdf' ])->name('caducar.pdf');
    Route::get('/reporte/caducar/word/', [ ReporteCaducar::class, 'word' ])->name('caducar.word');

    Route::get('/reporte/stock/pdf/{search}', [ ReporteStock::class, 'pdf' ])->name('stock.pdf');
    Route::get('/reporte/stock/word/{search}', [ ReporteStock::class, 'word' ])->name('stock.word');
    Route::get('/reporte/stock/pdf/', [ ReporteStock::class, 'pdfall' ])->name('all.pdf');
    Route::get('/reporte/stock/word/', [ ReporteStock::class, 'wordall' ])->name('all.word');

    Route::get('/reporte/sinsalida/pdf/', [ ReporteSinsalida::class, 'pdf' ])->name('sinsalida.pdf');
    Route::get('/reporte/sinsalida/word/', [ ReporteSinsalida::class, 'word' ])->name('sinsalida.word');

    Route::get('/reporte/proveedor/pdf/', [ ReporteProveedores::class, 'pdf' ])->name('proveedores.pdf');
    Route::get('/reporte/proveedor/word/', [ ReporteProveedores::class, 'word' ])->name('proveedores.word');

    Route::get('/reporte/solicitudes/pdf/{estadoSeleccionado}', [ ReporteSolicitudes::class, 'pdf' ])->name('solicitudes.pdf');
    Route::get('/reporte/solicitudes/word/{estadoSeleccionado}', [ ReporteSolicitudes::class, 'word' ])->name('solicitudes.word');
    
    Route::get('/reporte/solicitudes/pdf/{solicitanteId}', [ ReporteSolicitudes::class, 'pdfSelect' ])->name('solicitud.pdf');
    
    Route::get('/reporte/kardex/pdf/{productoId}', [ Kardex::class, 'pdf' ])->name('kardex.pdf');
    Route::get('/reporte/kardex/word/{productoId}', [ Kardex::class, 'word' ])->name('kardex.word');

});
