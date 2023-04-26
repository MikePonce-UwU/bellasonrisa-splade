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
                            <span class="font-bold">{{ str($invoice->numero_factura)->lcfirst() }}</span>
                        @endcell
                        @cell('tipo_factura', $invoice)
                            <span class="text-xs bg-indigo-700 px-2 py-1 rounded shadow-md text-gray-50">{{ str($invoice->tipo_factura)->upper() }}</span>
                        @endcell
                        @cell('razon', $invoice)
                            {{ str($invoice->razon)->ucfirst() }}
                        @endcell
                        @cell('total_factura', $invoice)
                            C$  {{ number_format($invoice->total_factura, 2) }}
                        @endcell
                        @cell('created_at', $invoice)
                            {{ $invoice->created_at->shortMonthName }}/{{ $invoice->created_at->year }}
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
            <x-splade-group name="tipo_factura" label="Tipo de factura:" class="mb-2">
                <x-splade-radio name="tipo_factura" label="Arancel" value="arancel" />
                <x-splade-radio name="tipo_factura" label="Uniforme escolar" value="compra_uniforme_escolar" />
                <x-splade-radio name="tipo_factura" label="Uniforme Deportivo" value="compra_uniforme_deportivo" />
                <x-splade-radio name="tipo_factura" label="Matricula" value="matricula" />
                <x-splade-radio name="tipo_factura" label="Pago de planilla" value="pago_planilla" />
                {{-- <x-splade-radio name="tipo_factura" label="Arancel" value="payout" /> --}}
            </x-splade-group>
            <x-splade-checkbox name="income" label="Está entrando dinero? (Dejar sin seleccionar si no)" class="mb-2" />
            <x-splade-select label="A nombre de:" name="user_id" :options="$users"
                placeholder="Selecciona el usuario a facturar..." class="my-2" />
            <x-splade-button secondary class="mt-4" @click.prevent="form.restore">
                Reiniciar
            </x-splade-button>
            <x-splade-submit label="Enviar" :spinner="true" class="mt-4" />
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
