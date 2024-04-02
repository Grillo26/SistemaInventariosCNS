<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitante;


class ReporteController extends Controller
{
    public function index_view ()
    {
        return view('pages.reporte.reporte-data');
    }
}
