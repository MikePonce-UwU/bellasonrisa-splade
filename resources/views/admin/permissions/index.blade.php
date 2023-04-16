@seoTitle(__('Lista de Permisos'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex align-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                {{ __('Permisos') }}
            </h2>
            <Link href="#nuevoRoleModal" class="text-indigo-500 text-md px-6">Nuevo registro</Link>
        </div>
    </x-slot>

    <div class="py-12">
        {{-- @dump(auth()->role()->created_at->format('h:i a')) --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-table :for="$permissions" />
                    {{-- @cell('name', $role)
                        <img class="h-8 w-8 rounded-full object-cover mr-2"
                                            src="{{ $role->profile_photo_url }}"
                                            alt="{{ $role->name }}">
                            {{ str($role->name)->title() }}
                        @endcell --}}
                    {{-- @cell('accion', $role)
                            <div class="">
                                <x-splade-link class="text-red-500 font-bold text-sm mx-2" :href="route('roles.destroy', $role)" method="delete"
                                    confirm="Borrando Registro"
                                    confirm-text="Estás seguro de continuar? Una vez que des 'click' a continuar, no habrá marcha atrás."
                                    confirm-button="Sí, continuar" cancel-button="No, vuelve atrás">Delete</x-splade-link>
                            </div>
                        @endcell
                    </x-splade-table> --}}
                </div>
            </div>
        </div>
    </div>
    <x-splade-modal name="nuevoPermissionModal">
        <h2 class="font-bold text-xl text-gray-800 mb-6">Nuevo registro</h2>
        <x-splade-form :action="route('permissions.store')" method="post">
            <x-splade-input name="name" label="Nombre del permiso" class="mb-2" />
            <x-splade-button secondary class="mt-4" @click.prevent="form.restore">
                Reiniciar
            </x-splade-button>
            <x-splade-submit label="Enviar" :spinner="true" class="mt-4" />
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
