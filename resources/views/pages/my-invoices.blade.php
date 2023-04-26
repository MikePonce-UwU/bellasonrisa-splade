@seoTitle(__('Lista de Facturas a mi nombre'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
            {{ __('Facturas registradas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-table :for="$invoices">
                        @cell('numero_factura', $invoice)
                            <span class="font-bold">{{ str($invoice->numero_factura)->upper() }}</span>
                        @endcell
                        @cell('tipo_factura', $invoice)
                            <span
                                class="text-xs bg-indigo-700 px-2 py-1 rounded shadow-md text-gray-50">{{ str($invoice->tipo_factura)->headline() }}</span>
                        @endcell
                        @cell('razon', $invoice)
                            {{ str($invoice->razon)->ucfirst() }}
                        @endcell
                        @cell('total_factura', $invoice)
                            C$ {{ number_format($invoice->total_factura, 2) }}
                        @endcell
                        @cell('created_at', $invoice)
                            {{ $invoice->created_at->shortMonthName }}/{{ $invoice->created_at->year }}
                        @endcell
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
