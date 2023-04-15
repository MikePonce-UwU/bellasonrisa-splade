@seoTitle(__('Ver una asignatura'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
            {{ __('Editar registro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-form :default="$subject" method="put" :action="route('subjects.update', $subject)">
                        <x-splade-input name="nombre_largo" label="Nombre de la Materia" class="mb-2" :value="str()->title($subject->nombre_largo)" />
                        <x-splade-input name="nombre_corto" label="Acrónimo de la Materia" class="mb-2" :value="str()->lower($subject->corto)" />
                        <x-splade-textarea name="categoria_asignatura" autosize label="Categoría de Materia"
                            class="mb-2" :value="str()->lower($subject->categoria_asignatura)" />
                        <x-splade-select label="Seleccione los grados a los que la Materia pertenece:" name="grados"
                            :options="$grades" option-label="nombre_corto" option-key="id" multiple choices relation
                            placeholder="Selecciona los grados..." />
                        <x-splade-submit secondary label="Modificar ahora" class="mt-2" />
                        <x-splade-button @click.prevent="form.restore">Restaurar</x-splade-button>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
