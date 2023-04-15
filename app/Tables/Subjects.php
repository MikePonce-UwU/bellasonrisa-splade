<?php

namespace App\Tables;

use App\Models\Subject;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Subjects extends AbstractTable
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
        return Subject::query()->withCount(['grades']);
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
            ->withGlobalSearch(columns: ['nombre_largo', 'nombre_corto'])
            ->column('id', label: '#', sortable: true, alignment: 'right', canBeHidden: false)
            ->column('nombre_corto', label: 'Acrónimo', sortable: true)
            ->column('nombre_largo', label: 'Nombre de la clase', sortable: true)
            ->column('grades_count', label: 'Grados', sortable: false)
            ->rowLink(function(Subject $subject) {
                return route('subjects.show', $subject);
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
