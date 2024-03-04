<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;


class ProductoController extends Controller
{
    public function index_view ()
    {
        return view('pages.producto.producto-data', [
            'producto' => Producto::class
        ]);
    }
}
