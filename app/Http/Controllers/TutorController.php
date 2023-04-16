<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Http\Requests\StoreTutorRequest;
use App\Http\Requests\UpdateTutorRequest;
use App\Models\Student;
use App\Tables\Tutors;

class TutorController extends Controller
{
    private $tutors, $students;
    public function __construct()
    {
        $this->tutors = Tutors::class;
        $this->students = Student::pluck('nombre_completo', 'id');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin
        .tutors.index', ['tutors' => $this->tutors, 'students' => $this->students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTutorRequest $request)
    {
        $tutor = Tutor::create([
            'nombre_completo' => $request->safe()->nombre_completo,
            'email' => $request->safe()->email,
            'password' => bcrypt($request->safe()->password),
            'sexo' => $request->safe()->sexo,
        ]);
        return redirect()->route('tutors.index')->with('flash.banner', '[' . $tutor->created_at . '] El padre de familia fue creado: ' . $tutor->nombre_completo)->with('flash.bannerStyle', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tutor $tutor)
    {
        //
        return view('admin
        .tutors.show', ['tutor' => $tutor, 'students' => $this->students]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Tutor $tutor)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTutorRequest $request, Tutor $tutor)
    {
        //
        $tutor->nombre_completo = $request->input('nombre_completo');
        $tutor->email = $request->input('email');
        $request->input('password') !== null ? $tutor->password = $request->input('password') : null;
        $tutor->sexo = $request->input('sexo');
        // dd($tutor);
        $tutor->save();
        return redirect()->route('tutors.index')->with('flash.banner', '[' . $tutor->updated_at . '] El padre de familia fue modificado: ' . $tutor->nombre_completo)->with('flash.bannerStyle', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tutor $tutor)
    {
        //
        $tutor->delete();
        return redirect()->route('tutors.index')->with('flash.banner', '[' . $tutor->deleted_at . '] El padre de familia fue eliminado: ' . $tutor->nombre_completo)->with('flash.bannerStyle', 'danger');
    }
}
