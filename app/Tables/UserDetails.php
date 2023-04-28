<?php

namespace App\Tables;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class UserDetails extends AbstractTable
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
        return UserDetail::query();
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
            ->withGlobalSearch(columns: ['user_id'])
            ->column('id', label: '#', sortable: true, canBeHidden: false, alignment: 'right')
            ->column('user.name', label: 'Nombre de usuario', sortable: true, searchable: true)
            ->column('rango_horas', label: 'Rango de horas', sortable: true)
            ->column('dias_laborales', label: 'Días que trabaja', sortable: true)
            ->rowLink(function(UserDetail $detail){
                return route('user_details.show', $detail);
            })

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
            ;
    }
}
