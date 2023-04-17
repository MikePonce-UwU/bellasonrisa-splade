@seoTitle(__('Ver un usuario'))

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
                    <x-splade-form :default="$user" method="put" :action="route('users.update', $user)">
                        <x-splade-input name="id" class="mb-2 hidden" />
                        <x-splade-input name="name" label="Nombre de usuario" class="mb-2" />
                        <x-splade-input name="email" type="email" label="Correo electrónico" class="mb-2" />
                        <x-splade-input name="password" type="password" label="Contraseña" class="mb-2" />
                        <x-splade-input name="password_confirmation" type="password" label="Confirmar contraseña"
                            class="mb-2" />
                        {{-- <x-splade-group name="sexo" label="Sexo del user" :show-errors="true" class="mb-2">
                <x-splade-radio name="sexo" value="m" label="Masculino" />
                <x-splade-radio name="sexo" value="f" label="Femenino" />
            </x-splade-group> --}}
                        @if (\App\MKPonce\MKPonce::supportsRolesManagement())
                            <x-splade-select label="Seleccione el rol:" name="roles" :options="$roles" multiple
                                choices relation placeholder="Seleccione un rol..." class="mb-2" />
                        @endif
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
