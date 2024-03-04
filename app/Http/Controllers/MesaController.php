<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesa;


class MesaController extends Controller
{
    public function index_view ()
    {
        return view('pages.mesa.mesa-data', [
            'mesa' => Mesa::class
        ]);
    }
}
