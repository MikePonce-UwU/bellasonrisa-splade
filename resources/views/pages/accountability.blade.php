@seoTitle(__('Contabilidad'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
            {{ __('Contabilidad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <span class="py-12 px-6">
                        Entradas: C${{ number_format($entradas, 2) }}
                    </span>
                    <span class="py-12 px-6">
                        Salidas: C${{ number_format($salidas, 2) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
