@seoTitle(__('Calificaciones'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex align-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                {{ __('Calificaciones') }}
            </h2>
            <Link href="#nuevoInvoiceModal" class="text-indigo-500 text-md px-6">Nueva factura</Link>
        </div>
    </x-slot>
    {{-- @dd($materias) --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <Scores :materias="@js($materias)" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

