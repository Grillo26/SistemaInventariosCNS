<?php

namespace App\Http\Controllers;

use App\Models\Unidad;

class UnidadController extends Controller
{
    public function index_view ()
    {
        return view('pages.unidad.unidad-data', [
            'unidad' => Unidad::class
        ]);
    }
}
