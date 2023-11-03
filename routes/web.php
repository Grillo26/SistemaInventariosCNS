<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\UnidadController;
use Illuminate\Support\Facades\Route;

use App\Http\livewire\Productos;
use App\Http\livewire\Grupos;
use App\Http\livewire\Cuentas;
use App\Http\livewire\Salidas;
use App\Http\livewire\Unidades;
use App\Http\livewire\Entradas;
use App\Http\livewire\Comprobate;

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
    Route::view('/dashboard', "dashboard")->name('dashboard');

    Route::get('/user', [ UserController::class, "index_view" ])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');

    Route::get('productos', Productos::class)->name('productos');
    Route::view('/productos/new', "pages.productos.productos-new")->name('productos.new');

    Route::get('/grupos', [ GrupoController::class, "index_view" ])->name('grupos');
    Route::view('/grupos/new', "pages.grupo.grupo-new")->name('grupos.new');
    Route::view('/grupos/edit/{grupoId}', "pages.grupo.grupo-edit")->name('grupos.edit');

    Route::get('/cuentas', [ CuentaController::class, "index_view" ])->name('cuentas');
    Route::view('/cuentas/new', "pages.cuenta.cuenta-new")->name('cuentas.new');
    Route::view('/cuentas/edit/{cuentaId}', "pages.cuenta.cuenta-edit")->name('cuentas.edit');

    Route::get('/unidades', [ UnidadController::class, "index_view" ])->name('unidades');
    Route::view('/unidades/new', "pages.unidad.unidad-new")->name('unidades.new');
    Route::view('/unidades/edit/{cuentaId}', "pages.unidad.unidad-edit")->name('unidades.edit');


    Route::get('salidas', Salidas::class)->name('salidas');

    Route::get('entradas', Entradas::class)->name('entradas');

    Route::get('comprobantes', Comprobate::class)->name('comprobantes');
});
