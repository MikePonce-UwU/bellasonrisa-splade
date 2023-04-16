@seoTitle(__('Ver un tutor'))

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
                    <x-splade-form :default="$tutor" method="put" :action="route('tutors.update', $tutor)">
                        <x-splade-input name="id" label="id" class="mb-2 hidden" disabled />
                        <x-splade-input name="nombre_completo" label="Nombre de Tutor" class="mb-2" :value="str($tutor->nombre_completo)->lower()" />
                        <x-splade-input name="email" email label="Correo electrónico" class="mb-2" />
                        <x-splade-input name="password" password label="Contraseña" class="mb-2" />
                        <x-splade-input name="password_confirmation" password label="Confirmar contraseña" class="mb-2" />
                        <x-splade-group name="sexo" label="Sexo del tutor" :show-errors="true" class="mb-2">
                            <x-splade-radio name="sexo" value="m" label="Masculino" />
                            <x-splade-radio name="sexo" value="f" label="Femenino" />
                        </x-splade-group>
                        {{-- <x-splade-select label="Seleccione el alumno de quien es padre:" name="student"
                            :options="$students" option-label="nombre_completo" option-value="id" relation placeholder="Seleccione un estudiante..." class="mb-2" /> --}}
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
