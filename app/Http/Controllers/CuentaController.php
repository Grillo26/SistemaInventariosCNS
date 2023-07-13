<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;

class CuentaController extends Controller
{
    public function index_view ()
    {
        return view('pages.cuenta.cuenta-data', [
            'cuenta' => Cuenta::class
        ]);
    }
}
