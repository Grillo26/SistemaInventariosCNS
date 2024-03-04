<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;


class ProveedorController extends Controller
{
    public function index_view ()
    {
        return view('pages.proveedor.proveedor-data', [
            'proveedor' => Proveedor::class
        ]);
    }
}
