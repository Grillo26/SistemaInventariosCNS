<?php

namespace App\Http\Controllers;

use App\Models\Grupo;

class GrupoController extends Controller
{
    public function index_view ()
    {
        return view('pages.grupo.grupo-data', [
            'grupo' => Grupo::class
        ]);
    }
}
