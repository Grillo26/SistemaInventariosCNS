<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\CompraProducto;


class ProductoController extends Controller
{
    public function index_view ()
    {
        return view('pages.producto.producto-data', [
            'producto' => Producto::class
        ]);
    }

    public function stock(){
        return view('pages.producto.stock', [
            'entrada' => CompraProducto::class
        ]);
    }
}
