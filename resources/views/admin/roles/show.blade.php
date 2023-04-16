@seoTitle(__('Ver un rol'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
            Rol: {{ str($role->name)->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-form :default="$role" method="put" :action="route('roles.update', $role)">
                        {{-- <x-splade-input name="id"class="mb-2 hidden" /> --}}
                        {{-- <x-splade-input name="name" label="Nombre de role" class="mb-2" /> --}}
                        <x-splade-select label="Seleccione el permiso:" name="permissions" :options="$permissions" multiple
                            choices relation placeholder="Seleccione un permiso..." class="mb-2" />
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
