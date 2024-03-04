<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasillo;


class PasilloController extends Controller
{
    public function index_view ()
    {
        return view('pages.pasillo.pasillo-data', [
            'pasillo' => Pasillo::class
        ]);
    }
}
