@seoTitle(__('Ver un detalle de usuario'))

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
                    <x-splade-form :default="$user_detail" method="put" :action="route('user_details.update', $user_detail)" class="grid grid-cols-12 gap-6">
                        <x-splade-input name="id" disabled class="mb-2 hidden" />
                        <x-splade-select label="Seleccione el usuario:" name="user" :options="$users" relation
                            placeholder="Seleccione un usuario..." class="mb-2 col-span-12" />
                        <x-splade-input label="Salario:" name="salario" placeholder="Salario del empleado" class="col-span-6" />
                        <x-splade-input label="Adelanto de salario:" name="adelantos" placeholder="Adelantos del empleado" class="col-span-6" />
                        <x-splade-input label="Hora de entrada:" name="hora_entrada" time
                            placeholder="Seleccione la hora en que el maestro entra" class="col-span-6" />
                        <x-splade-input label="Hora de salida:" name="hora_salida" time
                            placeholder="Seleccione la hora en que el maestro sale" class="col-span-6" />
                        <x-splade-checkboxes name="dias_laborales" label="Días que el maestro labura:" :options="[
                            'lunes' => 'Lunes',
                            'martes' => 'Martes',
                            'miercoles' => 'Miércoles',
                            'jueves' => 'Jueves',
                            'viernes' => 'Viernes',
                            'sabado' => 'Sábado',
                            'domingo' => 'Domingo',
                        ]" class="mb-2 col-span-12" />
                        <x-splade-button secondary class="mt-4 col-span-2" @click.prevent="form.restore">
                            Reiniciar
                        </x-splade-button>
                        <x-splade-submit label="Enviar" :spinner="true" class="mt-4 col-span-1" />
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
