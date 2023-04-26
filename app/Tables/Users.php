<?php

namespace App\Tables;

use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Users extends AbstractTable
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
        return User::query();
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
            ->withGlobalSearch(columns: ['name', 'email'])
            ->column('id', label: '#', sortable: true, canBeHidden: false, alignment: 'right')
            ->column('name', label: 'Nombre Usuario', sortable: true)
            ->column('email', label: 'Correo Electrónico', sortable: true);
        // ->column('roles.name', label: 'Roles', sortable: true)
        if (\App\MKPonce\MKPonce::supportsRolesManagement()) {
            $table
                ->column('roles.name', label: 'Roles', sortable: true);
        }
        $table
            ->column('accion', label: 'Acciones')
            ->rowLink(function (User $user) {
                return route('users.show', $user);
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
