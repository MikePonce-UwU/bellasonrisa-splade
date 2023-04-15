<?php

namespace App\Tables;

use App\Models\Student;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Students extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Student::query()->with(['grade', 'tutor']);
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['nombre_completo', 'cedula', 'telefono'])
            ->column(key: 'id', label: '#', sortable: true, canBeHidden: false, alignment: 'right')
            ->column(key: 'nombre_completo', label:'Nombre Estudiante', sortable: true, searchable: true)
            ->column(key: 'cedula', label: 'Cédula', sortable: true, searchable: true)
            ->column(key: 'tutor.nombre_completo', label: 'Padre de familia', sortable: true, searchable: true)
            ->column(key: 'grade.nombre_largo', label: 'Grado', sortable: true, searchable: true)
            ->column(key: 'accion', label: 'Acciones')
            ->rowLink(function(Student $student) {
                return route('students.show', $student);
            })

            // ->searchInput()
            ->selectFilter(key: 'sexo', label: 'Sexo', noFilterOptionLabel: 'Seleccione un sexo', options: [
                'm' => 'Masculino',
                'f' => 'Femenino',
            ])
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
            ;
    }
}
