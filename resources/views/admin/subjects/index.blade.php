@seoTitle(__('Lista de Materias'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex align-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                {{ __('Materias') }}
            </h2>
            <Link href="#nuevoMateriaModal" class="text-indigo-500 text-md px-6">Nueva Materia</Link>
        </div>
    </x-slot>

    <div class="py-12">
        {{-- @dump(auth()->user()->created_at->format('h:i a')) --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-table :for="$subjects">
                        @cell('nombre_largo', $subject)
                            {{ str()->title($subject->nombre_largo) }}
                        @endcell
                        @cell('grades_count', $subject)
                            <span class="text-white text-xs text-center text-bold bg-indigo-500 p-1 rounded-sm">{{ $subject->grades_count }}</span>
                        @endcell
                        @cell('accion', $subject)
                            <div class="">
                                <x-splade-link class="text-red-600 font-bold text-sm mx-2" :href="route('subjects.destroy', $subject)" method="delete"
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
    <x-splade-modal name="nuevoMateriaModal">
        <h2 class="font-bold text-xl text-gray-800 mb-6">Nuevo registro</h2>
        <x-splade-form :action="route('subjects.store')">
            <x-splade-input name="nombre_largo" label="Nombre de la Materia" class="mb-2" />
            <x-splade-input name="nombre_corto" label="Acrónimo de la Materia" class="mb-2" />
            <x-splade-textarea name="categoria_asignatura" autosize label="Categoría de Materia" class="mb-2" />
            <x-splade-select label="Seleccione los grados a los que la Materia pertenece:" name="grados"
                :options="$grades" option-label="nombre_corto" option-key="id" multiple choices relation
                placeholder="Selecciona los grados..." />
            <x-splade-button secondary class="mt-4" @click.prevent="form.restore">
                Reiniciar
            </x-splade-button>
            <x-splade-submit label="Enviar" :spinner="true" class="mt-4" />
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
