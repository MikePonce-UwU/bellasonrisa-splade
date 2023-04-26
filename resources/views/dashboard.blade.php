@seoTitle(__('Dashboard'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @role(['Maestro', 'Director', 'Sub-director', 'Auxiliar contable'])
                    <x-welcome />
                @endrole
                @role('Padre de familia')
                    {{-- @dd(auth()->user()->latestInvoice) --}}
                    <span class="mx-6 my-12"> [{{ str(auth()->user()->latestInvoice->created_at->shortMonthName)->upper }}] <b>Última factura registrada: </b>{{ str(auth()->user()->latestInvoice->numero_factura)->upper }}</span>
                    {{ str(auth()->user()->latestInvoice->created_at->shortMonthName)->exactly(now()->shortMonthName) ? 'Puede ver las notas del niño' : 'NO puede ver las notas del niño' }}
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>
