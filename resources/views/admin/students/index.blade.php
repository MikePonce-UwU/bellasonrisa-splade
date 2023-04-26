@seoTitle(__('Lista de Estudiantes'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex align-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                {{ __('Estudiantes') }}
            </h2>
            <Link href="#nuevoEstudianteModal" class="text-indigo-500 text-md px-6">Nueva Estudiante</Link>
        </div>
    </x-slot>
    {{-- @dd($tutors) --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-table :for="$students">
                        @cell('nombre_completo', $student)
                            {{ str()->title($student->nombre_completo) }}
                        @endcell
                        @cell('sexo', $student)
                            {{ $student->sexo === 'm' ? 'Masculino' : 'Femenino' }}
                        @endcell
                        @cell('accion', $student)
                            <div class="">
                                <x-splade-link class="text-red-600 font-bold text-sm mx-2" :href="route('students.destroy', $student)" method="delete"
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
    <x-splade-modal name="nuevoEstudianteModal">
        <h2 class="font-bold text-xl text-gray-800 mb-6">Nuevo registro</h2>
        <x-splade-form :action="route('students.store')">
            <x-splade-input name="nombre_completo" label="Nombre del Estudiante" class="mb-2" />
            <x-splade-input name="codigo_estudiante" label="Código de Estudiante" class="mb-2" />
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
            <x-splade-textarea name="lugar_nacimiento" label="Lugar de nacimiento" class="mb-2" />
            <x-splade-textarea name="direccion" label="Dirección" class="mb-2" />
            <x-splade-textarea name="expediente_medico" label="Expediente Médico" class="mb-2" />
            <x-splade-button secondary class="mt-4" @click.prevent="form.restore">
                Reiniciar
            </x-splade-button>
            <x-splade-submit label="Enviar" :spinner="true" class="mt-4" />
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
