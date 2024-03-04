<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitante;


class SolicitanteController extends Controller
{
    public function index_view ()
    {
        return view('pages.solicitante.solicitante-data', [
            'solicitante' => Solicitante::class
        ]);
    }
}
