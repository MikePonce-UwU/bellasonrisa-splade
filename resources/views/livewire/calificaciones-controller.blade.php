@seoTitle('Calificaciones')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-8">
            <div class="p-6">
                <h2 class="font-bold text-gray-900 align-center text-center text-2xl">
                    Añadir calificaciones
                </h2>
                <p class="text-center">
                    Por favor, añadir las notas ordenadamente, sin saltarse clases.
                </p>
                <div class="flex align-center justify-center my-2">
                    <div class="mx-2">
                        <label for="subjects" class="block">
                            <span class="block mb-1 text-gray-700 font-sans">Seleccione la materia a evaluar</span>
                            <div class="relative">
                                <div class="">
                                    <select name="subjects" id="subjects" wire:model="selectedMateria"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50">
                                        <option value="-1" selected disabled>
                                            --- Seleccione una de las opciones ---
                                        </option>
                                        @foreach ($materias as $materia)
                                            <option value="{{ $materia->id }}">
                                                {{ str($materia->nombre_largo)->title() . ' (' . $materia->nombre_corto . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </label>
                    </div>
                    @if ($selectedMateria != -1)
                        <div class="mx-2">
                            <label for="grades" class="block">
                                <span class="block mb-1 text-gray-700 font-sans">Seleccione el grado a evaluar</span>
                                <div class="relative">
                                    <div class="">
                                        <select name="grades" id="grades" wire:model="selectedGrado"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50">
                                            <option value="-1" selected disabled>
                                                --- Seleccione una de las opciones ---
                                            </option>
                                            @foreach ($grados as $key => $grado)
                                                <option value="{{ $key }}">{{ str($grado)->ucfirst() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endif
                    <div class="mx-2 mt-auto">
                        <button
                            class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 hover:bg-indigo-700 text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200"
                            wire:click="clearFilters">
                            <div class="flex items-center justify-center">
                                clear filters
                            </div>
                        </button>
                    </div>
                </div>
                @if ($selectedMateria != -1 && $selectedGrado != -1)
                    <div class="mx-2">
                        <div class="flex justify-center align-center my-6">
                            <div class="shadow-sm border border-gray-200 relative sm:rounded-md sm:overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-300 bg-white">
                                    <thead class="bg-gray-50">
                                        <tr class="text-center">
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase">
                                                Nombre Estudiante
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase">
                                                Nota
                                            </th>
                                            <!-- <th class="px-6 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase">
                                                Agregar
                                            </th> -->
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-300 bg-white">
                                        @foreach ($estudiantes as $key => $estudiante)
                                            <tr>
                                                <td class="whitespace-nowrap text-sm px-6 py-4 text-gray-500">
                                                    <div class="flex flex-nowrap justify-end items-center">
                                                        {{ str($estudiante->nombre_completo)->title() }}
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap text-sm px-6 py-4 text-gray-500">
                                                    <div class="flex rounded-md border border-gray-300 shadow-sm">
                                                        <input type="number" name="notas" id="notas" value="{{ $estudiante->subjects($selectedMateria)->nota_i_corte }}"
                                                            wire:change="addNota({{ $key }}, {{ $estudiante->id }}, $event.target.value)"
                                                            class="block w-full border-0 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed rounded-md" />
                                                    </div>
                                                </td>
                                                <!-- <td class="whitespace-nowrap text-sm px-6 py-4 text-gray-500">
                                                <div class="flex flex-row items-center justify-start">
                                                    <button class="text-red-400 text-sm font-bold mx-2" @click="addNota(key)">Añadir nota</button>
                                                </div>
                                            </td> -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="mx-2">
                    <div class="flex items-center justify-end">
                        <button
                            class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 hover:bg-indigo-700 text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200"
                            type="button"
                            :class="{
                                'bg-indigo-300': $selectedGrado == -1 || $selectedMateria == -1,
                            }"
                            wire:click="sendNotas" :disabled="$selectedGrado == -1 || $selectedMateria == -1">
                            Enviar notas
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
