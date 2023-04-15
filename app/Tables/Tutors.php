<?php

namespace App\Tables;

use App\Models\Tutor;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Tutors extends AbstractTable
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
        return Tutor::query()->with('student');
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
            ->withGlobalSearch(columns: ['nombre_completo', 'email'])
            ->column('id', label: '#', sortable: true, canBeHidden: false, alignment: 'right')
            ->column('nombre_completo', label: 'Nombre Completo', sortable: true, searchable: true)
            ->column('email', label: 'Correo Electrónico', sortable: true, searchable: true)
            ->column('student.nombre_completo', label: 'Estudiante familiar', sortable: true, searchable: true)
            ->column('accion', label: 'Acciones', canBeHidden: false)
            ->rowLink(function (Tutor $tutor){
                return route('tutors.show', $tutor);
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
