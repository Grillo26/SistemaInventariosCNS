<?php

namespace App\Http\Controllers;

use App\Models\Estante;

class EstanteController extends Controller
{
    public function index_view ()
    {
        return view('pages.estante.estante-data', [
            'estante' => Estante::class
        ]);
    }
}
