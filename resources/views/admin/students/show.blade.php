@seoTitle(__('Ver una Estudiante'))

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
                    <x-splade-form :default="$student" method="put" :action="route('students.update', $student)">
                        <x-splade-input name="nombre_completo" label="Nombre del Estudiante" class="mb-2" />
                        <x-splade-input name="fecha_nacimiento" label="Fecha de Nacimiento" date class="mb-2" />
                        <x-splade-input name="cedula" label="Cédula del Estudiante" class="mb-2"
                            placeholder="###-######-####A" />
                        <x-splade-input name="telefono" label="Teléfono del Estudiante" class="mb-2" />
                        <x-splade-group name="sexo" label="Sexo del estudiante" :show-errors="true">
                            <x-splade-radio name="sexo" value="m" label="Masculino" />
                            <x-splade-radio name="sexo" value="f" label="Femenino" />
                        </x-splade-group>
                        <x-splade-select label="Seleccione el padre de familia:" name="tutor_id" :options="$tutors"
                            placeholder="Selecciona el padre..." class="my-2" />
                        <x-splade-select label="Seleccione el grado al que el Estudiante pertenece:" name="grade_id"
                            :options="$grades" placeholder="Selecciona los grados..." class="my-2" />
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
