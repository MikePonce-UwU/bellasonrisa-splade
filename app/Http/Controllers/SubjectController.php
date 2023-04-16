<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Tables\Subjects;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subjects.index', ['subjects' => Subjects::class, 'grades' => Grade::pluck('nombre_largo', 'id')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre_largo' => 'required|string|unique:subjects,nombre_largo|min:5',
            'nombre_corto' => 'required|string|min:3',
            'categoria_asignatura' => 'string|min:10',
            'grados' => 'array',
        ]);
        // return $inputs;
        $subject = Subject::create([
            'nombre_largo' => str()->lower($request->input('nombre_largo')),
            'nombre_corto' => str()->upper($request->input('nombre_corto')),
            'categoria_asignatura' => str()->title($request->input('categoria_asignatura'))
        ]);
        $subject->grados()->sync($request->input('grados'));
        return redirect()->route('subjects.index')->with('flash.banner', '[' . $subject->created_at . '] Materia creada: ' . $subject->nombre_largo)->with('flash.bannerStyle', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
        return view('admin.subjects.show', ['subject' => $subject, 'grades' => Grade::pluck('nombre_largo', 'id')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
        $request->validate([
            'nombre_largo' => 'required|string|unique:subjects,nombre_largo,' . $subject->id .'|min:5',
            'nombre_corto' => 'required|string|min:3',
            'categoria_asignatura' => 'required|string|min:10',
            'grados' => 'array',
        ]);
        // return $inputs;
        $subject->update([
            'nombre_largo' => str()->lower($request->input('nombre_largo')),
            'nombre_corto' => str()->upper($request->input('nombre_corto')),
            'categoria_asignatura' => str()->title($request->input('categoria_asignatura'))
        ]);
        $subject->grados()->sync($request->input('grados') ?? []);
        return redirect()->route('subjects.index')->with('flash.banner', '[' . $subject->created_at . '] Materia creada: ' . $subject->nombre_largo)->with('flash.bannerStyle', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
        $subject->delete();
        return redirect()->route('subjects.index')->with('flash.banner', '[' . $subject->deleted_at . '] Materia eliminada: ' . $subject->nombre_largo)->with('flash.bannerStyle', 'danger');
    }
}
