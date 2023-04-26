<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    //
    public function index()
    {
        return view('matricula', ['grades' => \App\Models\Grade::pluck('nombre_largo', 'id')]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => [
                'required',
                'string',
                'min:5',
            ],
            'apellidos' => [
                'required',
                'string',
                'min:5',
            ],
            'codigo_estudiante' => [
                'required',
                'string',
                'min:5',
                'unique:students,codigo_estudiante',
            ],
            'fecha_nacimiento' => [
                'required',
                'date'
            ],
            'sexo_estudiante' => [
                'required',
                'in:m,f',
            ],
            'lugar_nacimiento' => [
                'required',
            ],
            'grade_id' => [
                'required',
            ],
            'direccion' => [
                'required',
            ],
            'expediente_medico' => [
                '',
            ],
            //
            'nombre_completo' => [
                'required',
                'string',
                'min:5',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'telefono' => [
                'required',
            ],
            'cedula' => [
                'required',
            ],
            'sexo_padre' => [
                'required',
                'in:m,f',
            ],
        ]);
        $padre = new \App\Models\User([
            'name' => $request->input('nombre_completo'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'cedula' => $request->input('cedula'),
            'sexo' => $request->input('sexo_padre'),
            'password' => bcrypt('123'),
        ]);

        $padre->save();
        $padre->assignRole(6);

        $nombre_completo = str($request->input('nombres'))->append(' ' . $request->input('apellidos'))->headline();

        $estudiante = new \App\Models\Student([
            'nombre_completo' => $nombre_completo,
            'codigo_estudiante' => $request->input('codigo_estudiante'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'sexo' => $request->input('sexo_estudiante'),
            'lugar_nacimiento' => $request->input('lugar_nacimiento'),
            'direccion' => $request->input('direccion'),
            'grade_id' => $request->input('grade_id'),
            'expediente_medico' => $request->input('expediente_medico'),
            'tutor_id' => $padre->id,
        ]);
        $estudiante->save();
        session()->flash('flash.banner', '[' . now() . '] Matrícula registrada correctamente, por favor presentarse al centro estudiantil para proceder al pago de matrícula.');
    }
}
