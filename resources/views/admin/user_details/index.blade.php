@seoTitle(__('Detalles de usuario'))

<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                {{ __('Usuarios') }}
            </h2>
    </x-slot>

    <div class="py-12">
        {{-- @dump(auth()->user()->created_at->format('h:i a')) --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-splade-table :for="$user_details">
                        @cell('user.name', $user_detail)
                            <img class="h-8 w-8 rounded-full object-cover mr-2" src="{{ $user_detail->user->profile_photo_url }}"
                                alt="{{ $user_detail->user->name }}">
                            {{ str($user_detail->user->name)->title() }}
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
</x-app-layout>
