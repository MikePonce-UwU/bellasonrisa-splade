@seoTitle(__('Ver una factura'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
            {{ __('Editar registro') }}
        </h2>
    </x-slot>
    {{-- @dd($invoice) --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-form :default="$invoice" method="put" :action="route('invoices.update', $invoice)">
                        <x-splade-input name="numero_factura" label="Número de factura" class="mb-2" />
                        <x-splade-input name="razon" label="Razón de la factura" class="mb-2" />
                        <x-splade-textarea name="descripcion_factura" label="Descripción de la factura" autosize
                            class="mb-2" />
                        <x-splade-input name="total_factura" label="Total facturado" class="mb-2" />
                        <x-splade-group name="tipo_factura" label="Tipo de factura:" class="mb-2">
                            <x-splade-radio name="tipo_factura" label="Arancel" value="arancel" />
                            <x-splade-radio name="tipo_factura" label="Uniforme escolar"
                                value="compra_uniforme_escolar" />
                            <x-splade-radio name="tipo_factura" label="Uniforme Deportivo"
                                value="compra_uniforme_deportivo" />
                            <x-splade-radio name="tipo_factura" label="Matricula" value="matricula" />
                            <x-splade-radio name="tipo_factura" label="Pago de planilla" value="pago_planilla" />
                            {{-- <x-splade-radio name="tipo_factura" label="Arancel" value="payout" /> --}}
                        </x-splade-group>
                        <x-splade-checkbox name="income" label="Está entrando dinero? (Dejar sin seleccionar si no)"
                            class="mb-2" />
                        <x-splade-select label="A nombre de:" name="user_id" :options="$users"
                            placeholder="Selecciona el usuario a facturar..." class="my-2" />
                        <x-splade-button secondary class="mt-4" @click.prevent="form.restore">
                            Reiniciar
                        </x-splade-button>
                        <x-splade-submit label="Enviar" :spinner="true" class="mt-4" />
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
