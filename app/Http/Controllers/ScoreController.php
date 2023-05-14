<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoreController extends Controller
{
    //
    public $materias;
    public function __construct()
    {
        // $this->materias = auth()->user()->load('subjects')->subjects;
    }
    public function index()
    {
        return view('pages.calificaciones.index', [
            'materias' => \App\Models\Subject::with('grades.students')->find(auth()->user()->subjects()->pluck('id')),
            // 'grados' => \App\Models\Grade::pluck('nombre_largo', 'id'),
        ]);
    }
}
