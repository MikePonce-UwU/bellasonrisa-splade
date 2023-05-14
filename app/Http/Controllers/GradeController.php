<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Tables\Grades;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\Facades\Splade;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.grades.index', ['grades' => Grades::class, 'subjects' => Subject::pluck('nombre_corto', 'id')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_largo' => 'required|string|unique:grades,nombre_largo|min:5'
        ]);
        // return $inputs;
        $grade = Grade::create(['nombre_largo' => $request->input('nombre_largo')]);
        $grade->subjects()->sync($request->input('subjects'));
        return redirect()->route('grades.index')->with('flash.banner' , '[' . $grade->created_at . '] Grado creado: ' . $grade->nombre_largo)->with('flash.bannerStyle' , 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        // $asignaturas = collect();
        // foreach ($grade->asignaturas as $a) {
        //     $asignaturas[$a->id] = ['grade' => $grade->id];
        // }
        return view('admin.grades.show', ['grade' => $grade, 'subjects' => Subject::pluck('nombre_corto', 'id')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        // dd($request->validate());
        $request->validate([
            'nombre_largo' => 'required|string|unique:grades,nombre_largo,' . $grade->id . '|min:5'
        ]);
        $grade->update(['nombre_largo' => $request->input('nombre_largo')]);
        $grade->subjects()->sync($request->input('subjects'));
        return redirect()->route('grades.index')->with('flash.banner', ' ['.$grade->updated_at .'] Grado fue modificado: ' .  $grade->nombre_largo )->with('flash.bannerStyle', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
        $grade->delete();
        return redirect()->route('grades.index')->with('flash.banner', '['. $grade->deleted_at . '] Registro borrado')->with('flash.bannerStyle', 'danger');
    }
}
