<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    //
    public function index() {
        return view('matricula', ['grades' => \App\Models\Grade::pluck('nombre_largo', 'id')]);
    }
    public function store(Request $request) {
        $nombre_completo= str($request->input('nombres'))->append(' ' .$request->input('apellidos'))->headline();
        dd($nombre_completo->value);
    }
}
