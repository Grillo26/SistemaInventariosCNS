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

use Illuminate\Support\Facades\Route;

use App\Http\livewire\Productos;
use App\Http\livewire\Cuentas;
use App\Http\livewire\Salidas;
use App\Http\livewire\Unidades;
use App\Http\livewire\Entradas;
use App\Http\livewire\Stock;
use App\Http\livewire\Comprobate;
use App\Http\livewire\Estad;
use App\Http\livewire\Mesa;
use App\Http\livewire\Dashboard;

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


    Route::get('salidas', Salidas::class)->name('salidas');

    Route::get('entradas', Entradas::class)->name('entradas');

    Route::get('stock', Stock::class)->name('stock');
    
    Route::get('comprobantes', Comprobate::class)->name('comprobantes');

    Route::get('estados', Estad::class)->name('estados');
});
