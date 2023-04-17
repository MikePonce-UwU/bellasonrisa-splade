@seoTitle(__('Lista de Usuarios'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex align-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                {{ __('Usuarios') }}
            </h2>
            <Link href="#nuevoUserModal" class="text-indigo-500 text-md px-6">Nuevo registro</Link>
        </div>
    </x-slot>

    <div class="py-12">
        {{-- @dump(auth()->user()->created_at->format('h:i a')) --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-table :for="$users">
                        @cell('name', $user)
                            <img class="h-8 w-8 rounded-full object-cover mr-2" src="{{ $user->profile_photo_url }}"
                                alt="{{ $user->name }}">
                            {{ str($user->name)->title() }}
                        @endcell
                        @cell('accion', $user)
                            <div class="">
                                <x-splade-link class="text-red-500 font-bold text-sm mx-2" :href="route('users.destroy', $user)" method="delete"
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
    <x-splade-modal name="nuevoUserModal">
        <h2 class="font-bold text-xl text-gray-800 mb-6">Nuevo registro</h2>
        <x-splade-form :action="route('users.store')" method="post">
            <x-splade-input name="name" label="Nombre de user" class="mb-2" />
            <x-splade-input name="email" type="email" label="Correo electrónico" class="mb-2" />
            <x-splade-input name="password" type="password" label="Contraseña" class="mb-2" />
            <x-splade-input name="password_confirmation" type="password" label="Confirmar contraseña" class="mb-2" />
            {{-- <x-splade-group name="sexo" label="Sexo del user" :show-errors="true" class="mb-2">
                <x-splade-radio name="sexo" value="m" label="Masculino" />
                <x-splade-radio name="sexo" value="f" label="Femenino" />
            </x-splade-group> --}}
            @if (\App\MKPonce\MKPonce::supportsRolesManagement())
                <x-splade-select label="Seleccione el rol:" name="roles" :options="$roles" multiple choices relation
                    placeholder="Seleccione un rol..." class="mb-2" />
            @endif
            <x-splade-button secondary class="mt-4" @click.prevent="form.restore">
                Reiniciar
            </x-splade-button>
            <x-splade-submit label="Enviar" :spinner="true" class="mt-4" />
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
