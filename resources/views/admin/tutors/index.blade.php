@seoTitle(__('Lista de Tutores'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex align-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                {{ __('Tutores') }}
            </h2>
            <Link href="#nuevoTutorModal" class="text-indigo-500 text-md px-6">Nueva Tutor</Link>
        </div>
    </x-slot>

    <div class="py-12">
        {{-- @dump(auth()->user()->created_at->format('h:i a')) --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-table :for="$tutors">
                        @cell('nombre_completo', $tutor)
                            {{ str($tutor->nombre_completo)->title() }}
                        @endcell
                        @cell('student.nombre_completo', $tutor)
                            <div class="flex flex-row items-center justify-center">
                                @foreach ($tutor->student as $s)
                                    {{ str($s->nombre_completo)->title() }} <br>
                                @endforeach
                            </div>
                        @endcell
                        @cell('accion', $tutor)
                            <div class="">
                                <x-splade-link class="text-red-600 font-bold text-sm mx-2" :href="route('tutors.destroy', $tutor)" method="delete"
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
    <x-splade-modal name="nuevoTutorModal">
        <h2 class="font-bold text-xl text-gray-800 mb-6">Nuevo registro</h2>
        <x-splade-form :action="route('tutors.store')" method="post">
            <x-splade-input name="nombre_completo" label="Nombre de Tutor" class="mb-2" />
            <x-splade-input name="email" type="email" label="Correo electrónico" class="mb-2" />
            <x-splade-input name="password" type="password" label="Contraseña" class="mb-2" />
            <x-splade-input name="password_confirmation" type="password" label="Confirmar contraseña" class="mb-2" />
            <x-splade-group name="sexo" label="Sexo del tutor" :show-errors="true" class="mb-2">
                <x-splade-radio name="sexo" value="m" label="Masculino" />
                <x-splade-radio name="sexo" value="f" label="Femenino" />
            </x-splade-group>
            {{-- <x-splade-select label="Seleccione el alumno de quien es padre:" name="student" :options="$students" relation
                placeholder="Seleccione un estudiante..." class="mb-2" /> --}}
            <x-splade-button secondary class="mt-4" @click.prevent="form.restore">
                Reiniciar
            </x-splade-button>
            <x-splade-submit label="Enviar" :spinner="true" class="mt-4" />
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
