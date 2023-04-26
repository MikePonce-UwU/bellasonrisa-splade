<?php

namespace App\Tables;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Invoices extends AbstractTable
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
        return auth()->user()->hasAnyRole(['Administrador', 'Sub-director', 'Auxiliar contable', 'Director']) || $request->user()->hasAnyRoles(['Administrador', 'Sub-director', 'Auxiliar contable', 'Director']);
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Invoice::query();
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
            ->withGlobalSearch(columns: ['numero_factura', 'razon', 'total_factura'])
            ->column('numero_factura', label: '#', sortable: true, canBeHidden: false, alignment:'right')
            ->column('user.name', label: 'A nombre de', sortable: true)
            ->column('tipo_factura', label: 'Tipo de Factura', sortable: true)
            ->column('razon', label: 'Razón', sortable: true)
            ->column('total_factura', label: 'Total facturado', sortable: true)
            ->column('created_at', label: 'Facturado', sortable: true)
            ->rowLink(function(Invoice $invoice) {
                return route('invoices.show', $invoice);
            })

            // ->searchInput()
            ->selectFilter(key: 'income', label: '¿Es entrada o salida de dinero?', noFilterOptionLabel: 'Seleccione un filtro', options: [
                true => 'Entrada',
                false => 'Salida',
            ])
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
            ;
            Carbon::class;
    }
}
