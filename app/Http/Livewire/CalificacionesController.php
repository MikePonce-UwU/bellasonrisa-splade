<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CalificacionesController extends Component
{
    public $materias = [], $grados = [], $estudiantes = [], $notas = [];
    public int $selectedMateria = -1, $selectedGrado = -1;

    public function mount()
    {
        $this->materias = \App\Models\Subject::find(auth()->user()->subjects()->pluck('id'));
    }

    public function render()
    {
        return view('livewire.calificaciones-controller', [
            'materias' => $this->materias,
        ])->layout('components.app-layout');
    }
    public function updatedSelectedMateria(int $newSelectedMateria)
    {
        if ($newSelectedMateria == -1) return $this->grados = null;
        if ($this->selectedGrado != -1) $this->selectedGrado = -1;
        $this->grados = \App\Models\Grade::with('subjects')
            ->whereHas('subjects', function ($q) use ($newSelectedMateria) {
                return $q->where(['subject_id' => $newSelectedMateria]);
            })
            ->pluck('nombre_largo', 'id');
        // dd($this->grados);
    }

    public function updatedSelectedGrado(int $newSelectedGrado)
    {
        if ($newSelectedGrado == -1) return $this->estudiantes = null;
        $this->estudiantes = \App\Models\Student::where('grade_id', $newSelectedGrado)->get();
        // dd($this->estudiantes);
    }

    public function clearFilters()
    {
        $this->reset(['selectedMateria', 'selectedGrado', 'grados', 'estudiantes']);
    }

    public function addNota(int $key, int $id, $nota)
    {
        dd($key, $id, $nota);
        $this->notas[$this->selectedMateria] = [
            "materia_id" => $this->materias[$this->selectedMateria]->id,
            "grades" => [],
        ];
        $this->notas[$this->selectedMateria]->grades[$this->selectedGrado] = [
            "grado_id" => $this->materias[$this->selectedMateria]->grades[$this->selectedGrado]->id,
            "students" => [],
        ];
        $this->notas[$this->selectedMateria]->grades[$this->selectedGrado]->students[$key] = [
            "estudiante_id" => $id,
            "calificacion" => $nota,
        ];
    }
}
