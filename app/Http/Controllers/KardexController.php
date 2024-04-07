<?php

namespace App\Http\Controllers;


class KardexController extends Controller
{
    public function index_view ()
    {
        return view('pages.kardex.kardex-data');
    }
}
