@seoTitle(__('Lista de Roles'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex align-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                {{ __('Roles') }}
            </h2>
            <Link href="#nuevoRoleModal" class="text-indigo-500 text-md px-6">Nuevo registro</Link>
        </div>
    </x-slot>

    <div class="py-12">
        {{-- @dump(auth()->role()->created_at->format('h:i a')) --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-table :for="$roles" />
                </div>
            </div>
        </div>
    </div>
    <x-splade-modal name="nuevoRoleModal">
        <h2 class="font-bold text-xl text-gray-800 mb-6">Nuevo registro</h2>
        <x-splade-form :action="route('roles.store')" method="post">
            <x-splade-input name="name" label="Nombre de role" class="mb-2" />
            @if (\App\MKPonce\MKPonce::supportsPermissionsManagement())
                <x-splade-select label="Seleccione el permiso:" name="permissions" :options="$permissions" multiple choices
                    relation placeholder="Seleccione un permiso..." class="mb-2" />
            @endif
            <x-splade-button secondary class="mt-4" @click.prevent="form.restore">
                Reiniciar
            </x-splade-button>
            <x-splade-submit label="Enviar" :spinner="true" class="mt-4" />
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
