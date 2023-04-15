<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Tutor;
use App\Tables\Students;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    private $grades, $students, $tutors;
    public function __construct()
    {
        $this->grades = Grade::pluck('nombre_largo', 'id');
        $this->tutors = Tutor::pluck('nombre_completo', 'id');
        $this->students = Students::class;
    }
    public function index()
    {
        return view('pages.students.index', ['students' => $this->students, 'grades' => $this->grades, 'tutors' => $this->tutors]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|min:5',
            'fecha_nacimiento' => 'required|date',
            'cedula' => 'required|string',
            'telefono' => 'required|string',
            'sexo' => 'required|in:m,f',
            'grade_id' => 'required',
            'tutor_id' => 'required'
        ]);
        $student = Student::create([
            'nombre_completo' => str()->lower($request->input('nombre_completo')),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'cedula' => str()->upper($request->input('cedula')),
            'telefono' => $request->input('telefono'),
            'sexo' => $request->input('sexo'),
            'grade_id' => $request->input('grade_id'),
            'tutor_id' => $request->input('tutor_id'),
        ]);
        return redirect()->route('students.index')->with('flash.banner', '[' . $student->created_at . '] El estudiante ha sido creado: ' . str($student->nombre_completo)->title())->with('flash.bannerStyle', 'success');
    }

    public function show(Student $student)
    {
        // dd($student->load('grade'));
        return view('pages.students.show', ['student' => $student, 'grades' => $this->grades, 'tutors' => $this->tutors]);
    }
    public function update(Request $request, Student $student)
    {
        // dd($request->input());
        $request->validate([
            'nombre_completo' => 'required|string|min:5',
            'fecha_nacimiento' => 'required|date',
            'cedula' => 'required|string',
            'telefono' => 'required|string',
            'sexo' => 'required|in:m,f',
            'grade_id' => 'required',
            'tutor_id' => 'required'
        ]);
        $student->update([
            'nombre_completo' => str()->lower($request->input('nombre_completo')),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'cedula' => str()->upper($request->input('cedula')),
            'telefono' => $request->input('telefono'),
            'sexo' => $request->input('sexo'),
            'grade_id' => $request->input('grade_id'),
            'tutor_id' => $request->input('tutor_id'),
        ]);
        return redirect()->route('students.index')->with('flash.banner', '[' . $student->updated_at . '] El estudiante ha sido modificado: ' . str($student->nombre_completo)->title())->with('flash.bannerStyle', 'success');
    }
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('flash.banner', '[' . $student->deleted_at . '] El estudiante ha sido eliminado: ' . str($student->nombre_completo)->title())->with('flash.bannerStyle', 'success');
    }
}
