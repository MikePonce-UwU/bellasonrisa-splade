@seoTitle(__('Lista de Facturas'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex align-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                {{ __('Facturas registradas') }}
            </h2>
            <Link href="#nuevoInvoiceModal" class="text-indigo-500 text-md px-6">Nueva factura</Link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-table :for="$invoices">
                        @cell('numero_factura', $invoice)
                            <span class="font-bold">{{ str($invoice->numero_factura)->upper() }}</span>
                        @endcell
                        @cell('razon', $invoice)
                            {{ str($invoice->razon)->ucfirst() }}
                        @endcell
                        @cell('total_factura', $invoice)
                            C$  {{ number_format($invoice->total_factura, 2) }}
                        @endcell
                        @cell('iva', $invoice)
                            C$  {{ number_format($invoice->iva, 2) ?? '0.00' }}
                        @endcell
                        @cell('accion', $invoice)
                            <div class="">
                                <x-splade-link class="text-red-600 font-bold text-sm mx-2" :href="route('invoices.destroy', $invoice)" method="delete"
                                    confirm="Borrando Registro"
                                    confirm-text="Estás seguro de continuar? Una vez que des 'click' a continuar, no habrá marcha atrás."
                                    confirm-button="Sí, continuar" cancel-button="No, vuelve atrás">Delete</x-splade-link>
                            </div>
                        @endcell
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
    <x-splade-modal name="nuevoInvoiceModal">
        <h2 class="font-bold text-xl text-gray-800 mb-6">Nuevo registro</h2>
        <x-splade-form :action="route('invoices.store')" :default="['income' => false]">
            <x-splade-input name="numero_factura" label="Número de factura" class="mb-2" />
            <x-splade-input name="razon" label="Razón de la factura" class="mb-2" />
            <x-splade-textarea name="descripcion_factura" label="Descripción de la factura" autosize class="mb-2" />
            <x-splade-input name="total_factura" label="Total facturado" class="mb-2" />
            <x-splade-checkbox name="income" label="Está entrando dinero? (Dejar sin seleccionar si no)" class="mb-2" />
            <x-splade-button secondary class="mt-4" @click.prevent="form.restore">
                Reiniciar
            </x-splade-button>
            <x-splade-submit label="Enviar" :spinner="true" class="mt-4" />
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
