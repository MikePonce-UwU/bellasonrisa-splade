<?php

namespace App\Tables;

use App\Models\Grade;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Grades extends AbstractTable
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
        return Grade::query()->withCount('students', 'subjects');
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
            ->withGlobalSearch(columns: ['nombre_largo'])
            ->column('id', label: '#', sortable: true, canBeHidden: false, alignment: 'right')
            ->column('nombre_largo', label: 'Nombre grado', sortable: true)
            ->column('students', label: 'Estudiantes', sortable: true)
            ->column('subjects', label: 'Asignaturas', sortable: true)
            ->rowLink(function(Grade $grade) {
                return route('grades.show', $grade);
            })
            ->column('accion', label: 'acción')
            ->paginate(5)
            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
            ;
    }
}
