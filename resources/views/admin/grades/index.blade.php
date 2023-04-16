@seoTitle(__('Lista de Grados'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex align-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                {{ __('Grados') }}
            </h2>
            <Link href="#nuevoGradoModal" class="text-indigo-500 text-md px-6">Nuevo Grado</Link>
        </div>
    </x-slot>

    <div class="py-12">
        {{-- @dump(auth()->user()->created_at->format('h:i a')) --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-table :for="$grades">
                        @cell('students', $grade)
                            <span
                                class="text-white text-xs text-center text-bold bg-indigo-500 p-1 rounded-sm">{{ $grade->students_count }}</span>
                        @endcell
                        @cell('subjects', $grade)
                            <span
                                class="text-white text-xs text-center text-bold bg-indigo-500 p-1 rounded-sm">{{ $grade->subjects_count }}</span>
                        @endcell
                        @cell('accion', $grade)
                            <div class="">
                                <x-splade-link class="text-red-600 font-bold text-sm mx-2" :href="route('grades.destroy', $grade)" method="delete"
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
    <x-splade-modal name="nuevoGradoModal">
        <h2 class="font-bold text-xl text-gray-800 mb-6">Nuevo registro</h2>
        <x-splade-form :action="route('grades.store')">
            <x-splade-input name="nombre_largo" label="Nombre del grado" class="mb-2" />
            <x-splade-select label="Seleccione las clases que el grado ve:" name="asignaturas" :options="$subjects"
                option-label="nombre_corto" option-key="id" multiple choices relation
                placeholder="Selecciona las asignaturas" />
            <x-splade-button class="mt-4" @click.prevent="form.restore">
                Restore default values
            </x-splade-button>
            <x-splade-submit label="Enviar" secondary :spinner="true" />
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
