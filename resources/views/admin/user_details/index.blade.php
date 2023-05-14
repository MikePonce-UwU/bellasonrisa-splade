@seoTitle(__('Detalles de usuario'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex align-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                {{ __('Usuarios') }}
            </h2>
            <Link href="#nuevoUserDetailModal" class="text-indigo-500 text-md px-6">Nuevo registro</Link>
        </div>
    </x-slot>

    <div class="py-12">
        {{-- @dump(auth()->user()->created_at->format('h:i a')) --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-table :for="$user_details">
                        @cell('user.name', $user_detail)
                            <img class="h-8 w-8 rounded-full object-cover mr-2"
                                src="{{ $user_detail->user->profile_photo_url }}" alt="{{ $user_detail->user->name }}">
                            {{ str($user_detail->user->name)->title() }}
                        @endcell
                        @cell('dias_laborales', $user_detail)
                            @foreach ($user_detail->dias_laborales as $d)
                                {{ str($d)->ucfirst() }} <br>
                            @endforeach
                        @endcell
                        @cell('user.subjects', $user_detail)
                            @foreach ($user_detail->user->subjects as $s)
                                {{ str($s->nombre_largo)->ucfirst() }} <br>
                            @endforeach
                        @endcell
                        @cell('salario', $user_detail)
                            <span>C$ {{ number_format($user_detail->salario, 2) }}</span>
                            @if ($user_detail->adelantos > 0)
                                <span class="text-red-400 pl-1">(C$ -{{ number_format($user_detail->adelantos, 2) }})</span>
                            @endif
                        @endcell
                        @cell('accion', $user_detail)
                            <div class="">
                                <x-splade-link class="text-red-500 font-bold text-sm mx-2" :href="route('users.destroy', $user_detail)" method="delete"
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
    <x-splade-modal name="nuevoUserDetailModal">
        <h2 class="font-bold text-xl text-gray-800 mb-6">Nuevo registro</h2>
        <x-splade-form :action="route('user_details.store')" method="post">
            <x-splade-select label="Usuario:" name="user_id" :options="$users" placeholder="Seleccione un usuario..."
                class="mb-2 col-span-12" />
            <x-splade-input label="Salario:" name="salario" placeholder="Salario del empleado" class="col-span-6" />
            <x-splade-input label="Adelanto de salario:" name="adelantos" placeholder="Adelantos del empleado"
                class="col-span-6" />
            <x-splade-input label="Hora de entrada:" name="hora_entrada" time
                placeholder="Seleccione la hora en que el maestro entra" class="col-span-6" />
            <x-splade-input label="Hora de salida:" name="hora_salida" time
                placeholder="Seleccione la hora en que el maestro sale" class="col-span-6" />

            <x-splade-select label="Días que el maestro trabaja:" name="dias_laborales" :options="[
                'lunes' => 'Lunes',
                'martes' => 'Martes',
                'miercoles' => 'Miércoles',
                'jueves' => 'Jueves',
                'viernes' => 'Viernes',
                'sabado' => 'Sábado',
                'domingo' => 'Domingo',
            ]" multiple
                choices placeholder="Seleccione los días..." class="mb-2 col-span-12" />
            <x-splade-select label="Materias que el maestro enseña:" name="materias" :options="$subjects" multiple choices
                placeholder="Seleccione las materias..." class="mb-2 col-span-12" />
            <x-splade-button secondary class="mt-4 col-span-2" @click.prevent="form.restore">
                Reiniciar
            </x-splade-button>
            <x-splade-submit label="Enviar" :spinner="true" class="mt-4 col-span-2" />
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
