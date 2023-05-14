@seoTitle(__('Ver un grado'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
            {{ __('Editar registro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- @dd($asignaturas[] = collect($grade->asignaturas->pluck('id'))->filter(fn($v) => $v)) --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-form :default="$grade" method="put" :action="route('grades.update', $grade)">
                        <x-splade-input name="nombre_largo" class="mb-2" label="Nombre del grado" />
                        <x-splade-select label="Seleccione las clases que el grado ve:" name="subjects" :options="$subjects" option-label="nombre_corto" option-key="id" multiple choices relation placeholder="Selecciona las asignaturas" />
                        <x-splade-submit secondary label="Modificar ahora" class="mt-2" />
                        <x-splade-button @click.prevent="form.restore">Restaurar a los datos originales
                        </x-splade-button>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
