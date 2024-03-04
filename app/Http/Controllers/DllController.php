<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dll;


class DllController extends Controller
{
    public function index_view ()
    {
        return view('pages.dll.dll-data', [
            'dll' => Dll::class
        ]);
    }
}
