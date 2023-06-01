<script setup>
import { computed, inject, onMounted, reactive, ref, watch } from "vue";
const Splade = inject("$splade");

const { materias } = defineProps({
    materias: [],
});

const selectedMateria = ref(-1);

const selectedGrado = ref(-1);

const grades = ref([]);

const students = ref([]);

// const notas = ref([]);
const data = reactive({
    notas: [],
});

function initNotas() {
    var notas = [];
    materias.forEach((materia, i) => {
        console.log(materia);
        notas.push([
            {
                id: materia.id,
                grades: [
                    {
                        id: 0,
                        students: [
                            {
                                id: 0,
                                calificacion: 0,
                            },
                        ],
                    },
                ],
            },
        ]);
        const grades = materia.grades;

        grades.forEach((grado, j) => {
            console.log(grado);
            notas[i].grades[j].id = grado.id;
            const students = grado.students;

            students.forEach((estudiante, k) => {
                console.log(estudiante);
                notas[i].grades[j].students[k].id = estudiante.id;
                notas[i].grades[j].students[k].calificacion = 0;
            });
        });
        data.notas = notas;
        console.log(data.notas);
    });
}

onMounted(() => {
    console.log("Iniciamos el sistema...");
    initNotas();
});

const getGradosPorMateria = (index) => {
    return materias[index].grades;
};

const getEstudiantesPorGrado = (index, subindex) => {
    return materias[index].grades[subindex].students;
};

watch(selectedMateria, (newSelectedMateria) => {
    console.log("nueva materia: " + newSelectedMateria);
    selectedGrado.value = -1;
    if (newSelectedMateria == -1) {
        return (grades.value = null);
    }
    return (grades.value = getGradosPorMateria(newSelectedMateria));
});

watch(selectedGrado, (newSelectedGrado) => {
    console.log("nuevo grado: " + newSelectedGrado);
    if (notas.value.length != 0) return;
    if (
        newSelectedGrado == -1 ||
        grades.value[newSelectedGrado].students.length == 0
    )
        return (students.value = null);
    // if () return students.value = null
    return (students.value = getEstudiantesPorGrado(
        selectedMateria.value,
        newSelectedGrado
    ));
});

const clearFilters = () => {
    selectedGrado.value = -1;
    selectedMateria.value = -1;
    grades.value = null;
    students.value = null;
};

const addNota = (selectedEstudiante, estudiante_id, calificacion) => {
    console.log("Materia indice: %s", selectedMateria.value);
    console.log("Grado indice: %s", selectedGrado.value);
    console.log("Indice: %s", selectedEstudiante);
    console.log("Estudiante id: %s", estudiante_id);
    console.log("Calificacion: %s", calificacion);
    if (notas.length == 0) notas.value.push([]);
    notas.value[selectedMateria.value] = {
        materia_id: materias[selectedMateria.value].id,
        grades: [],
    };
    notas.value[selectedMateria.value].grades[selectedGrado.value] = {
        grado_id:
            materias[selectedMateria.value].grades[selectedGrado.value].id,
        students: [],
    };
    notas.value[selectedMateria.value].grades[selectedGrado.value].students[
        selectedEstudiante
    ] = {
        estudiante_id: estudiante_id,
        calificacion: calificacion,
    };
    console.log(notas.value);
};

const sendNotas = () => {
    if (notas.length == 0 || notas == null) {
        console.log("primero añada notas a la sabana...");
    } else {
        console.log("enviando notas...");
        // Splade.emit('addNota', notas);
        Splade.visit("/calificaciones");
    }
};
</script>
<template>
    <!-- <button @click="count++">{{ count }}</button> -->
    <div>
        <h2 class="font-bold text-gray-900 align-center text-center text-2xl">
            Añadir calificaciones
        </h2>
        <p class="text-center">
            Por favor, añadir las notas ordenadamente, sin saltarse clases.
        </p>
        <div class="flex align-center justify-center mt-2">
            <div class="mx-2">
                <label for="subjects" class="block">
                    <span class="block mb-1 text-gray-700 font-sans"
                        >Seleccione la materia a evaluar</span
                    >
                    <div class="relative">
                        <div class="">
                            <select
                                name="subjects"
                                id="subjects"
                                v-model="selectedMateria"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50"
                            >
                                <option value="-1" selected disabled>
                                    --- Seleccione una de las opciones ---
                                </option>
                                <template
                                    v-for="(m, key) in materias"
                                    :key="m.id"
                                >
                                    <option :value="key">
                                        {{ m.nombre_corto + "(" + m.id + ")" }}
                                    </option>
                                </template>
                            </select>
                        </div>
                    </div>
                </label>
            </div>
            <div class="mx-2" v-if="selectedMateria != -1">
                <label for="subjects" class="block">
                    <span class="block mb-1 text-gray-700 font-sans"
                        >Seleccione la materia a evaluar</span
                    >
                    <div class="relative">
                        <div class="">
                            <select
                                name="grades"
                                id="grades"
                                v-model="selectedGrado"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50"
                            >
                                <option value="-1" selected disabled>
                                    --- Seleccione una de las opciones ---
                                </option>
                                <template v-for="(g, key) in grades" :key="key">
                                    <option :value="key">
                                        {{ g.nombre_largo + "(" + g.id + ")" }}
                                    </option>
                                </template>
                            </select>
                        </div>
                    </div>
                </label>
            </div>
            <div class="mx-2 my-auto">
                <button
                    class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 hover:bg-indigo-700 text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200"
                    v-on:click="clearFilters"
                >
                    <div class="flex items-center justify-center">
                        clear filters
                    </div>
                </button>
            </div>
        </div>
        <div
            class="flex justify-center align-center my-6"
            v-if="selectedMateria != -1 && selectedGrado != -1"
        >
            <div
                class="shadow-sm border border-gray-200 relative sm:rounded-md sm:overflow-hidden"
            >
                <table class="min-w-full divide-y divide-gray-300 bg-white">
                    <thead class="bg-gray-50">
                        <tr class="text-center">
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase"
                            >
                                Nombre Estudiante
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase"
                            >
                                Nota
                            </th>
                            <!-- <th class="px-6 py-3 text-left text-xs font-medium tracking-wide text-gray-500 uppercase">
                                                    Agregar
                                                </th> -->
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300 bg-white">
                        <tr v-for="(s, key) in students" :key="key">
                            <td
                                class="whitespace-nowrap text-sm px-6 py-4 text-gray-500"
                            >
                                <div
                                    class="flex flex-nowrap justify-end items-center"
                                >
                                    {{ s.nombre_completo + " (" + s.id + ")" }}
                                </div>
                            </td>
                            <td
                                class="whitespace-nowrap text-sm px-6 py-4 text-gray-500"
                            >
                                <div
                                    class="flex rounded-md border border-gray-300 shadow-sm"
                                >
                                    <input
                                        type="number"
                                        name="notas"
                                        class="block w-full border-0 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed rounded-md"
                                        v-on:change="
                                            addNota(
                                                key,
                                                s.id,
                                                $event.target.value
                                            )
                                        "
                                    />
                                </div>
                            </td>
                            <!-- <td class="whitespace-nowrap text-sm px-6 py-4 text-gray-500">
                                                    <div class="flex flex-row items-center justify-start">
                                                        <button class="text-red-400 text-sm font-bold mx-2" @click="addNota(key)">Añadir nota</button>
                                                    </div>
                                                </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <button
            class="flex items-center px-6 py-2 rounded bg-indigo-500 text-white mx-auto"
            :class="{
                'bg-indigo-300': selectedGrado == -1 || selectedMateria == -1,
            }"
            v-on:click="sendNotas"
            :disabled="selectedGrado == -1 || selectedMateria == -1"
        >
            Enviar notas
        </button>
    </div>
    {{ selectedMateria }}
    <br />
    {{ selectedGrado }}
    <br />
    {{ notas }}
</template>
