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
                        <x-splade-checkbox name="income" label="Está entrando dinero? (Dejar sin seleccionar si no)"
                            class="mb-2" />
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
