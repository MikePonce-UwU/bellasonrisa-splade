<script setup>
import { computed, inject, ref } from 'vue';
const Splade = inject("$splade");

/**
 * propiedad materias, proveniente del controlador
 */
const { materias } = defineProps({
    materias: [],
});

/**
 *
 * materia seleccionada
 */
const selectedMateria = ref(-1);

/**
 *
 * grado seleccionado
 */
const selectedGrado = ref(-1);

// const subjects = ref(materias);

/**
 * lista de grados
 */
const grades = ref([]);

/**
 * lista de estudiantes
 */
const students = ref([]);

/**
 * lista de notas almacenadas una vez que se agrega una nota en la funcion :addNota()
 */
const notas = [];

/**
 * Agregar nota a la variable @notas
 * @returns void
 */
const addNota = (key, estudiante_id, calificacion) => {
    console.log("Indice: %s", key);
    console.log("Materia indice: %s", selectedMateria.value);
    console.log("Grado indice: %s", selectedGrado.value);
    console.log("Estudiante id: %s", estudiante_id);
    console.log("Calificacion: %s", calificacion);
    // notas.value.push(nota);
    notas[selectedMateria.value] = {
        materia_id: materias[selectedMateria.value].id,
        grades: [],
    };
    notas[selectedMateria.value].grades[selectedGrado.value] = {
        grado_id: materias[selectedMateria.value].grades[selectedGrado.value].id,
        students: [],
    };
    notas[selectedMateria.value].grades[selectedGrado.value].students[key] = {
        estudiante_id: estudiante_id,
        calificacion: calificacion,
    }
    // notas[selectedMateria.value].grades[selectedGrado.value].grado_id = materias[selectedMateria.value].grades[selectedGrado.value].id;
    // notas[selectedMateria.value].grades[selectedGrado.value].students[key].estudiante_id = materias[selectedMateria.value].grades[selectedGrado.value].students[key].id;
    // notas[selectedMateria.value].grades[selectedGrado.value].students[key].calificacion = materias[selectedMateria.value].grades[selectedGrado.value].students[key].calificacion;

    console.log(notas);
}

/**
 * Variable computarizada que retorna un arreglo de datos con los grados de la materia seleccionada
 *
 * @returns array
 */
const getGradosPorMateria = computed(() => {
    console.log(selectedMateria.value);
    selectedGrado.value = -1;
    return selectedMateria.value != -1 ? materias[selectedMateria.value].grades : null;
    // console.log(grades);
})

/**
 * Variable computarizada que retorna un arreglo de datos con los estudiantes de la materia y grado seleccionado
 *
 * @returns array
 */
const getEstudiantesPorGrado = computed(() => {
    console.log(selectedGrado.value);
    return selectedGrado != -1 && selectedMateria.value != -1 ? materias[selectedMateria.value].grades[selectedGrado.value].students : null;
    // console.log(students);
})

/**
 * Funcion vacia que envia las notas al controlador en Laravel
 * @returns void
 */
const sendNotas = () => {
    if (notas.length == 0 || notas == null) {
        console.log('primero añada notas a la sabana...')
    } else {
        console.log('enviando notas...');
        // Splade.emit('addNota', notas);
        Splade.visit('/calificaciones');
    }
}

/**
 * Limpiador de filtros en la UI
 * @returns void
 */
const clearFilters = () => {
    selectedGrado.value = -1;
    selectedMateria.value = -1;
    // subjects = null;
    // grades = null;
    // students = null;
    // subjects = materias;
}

</script>
<template>
    <!-- <button @click="count++">{{ count }}</button> -->
    <div>
        <div>
            <select name="subjects" id="subjects" v-model="selectedMateria">
                <option value="-1" selected disabled>--- Seleccione una de las opciones ---</option>
                <template v-for="(m, key) in materias" :key="m.id">
                    <option :value="key">{{ m.nombre_corto + "(" + m.id + ")" }}</option>
                </template>
            </select>
            <select name="grades" id="grades" v-show="selectedMateria != -1" v-model="selectedGrado">
                <option value="-1" selected disabled>--- Seleccione una de las opciones ---</option>
                <template v-for="(g, key) in getGradosPorMateria" :key="key">
                    <option :value="key">{{ g.nombre_largo + "(" + g.id + ")" }}</option>
                </template>
            </select>
            <button class="flex items-center px-6 py-2 rounded bg-indigo-500 text-white" v-on:click="clearFilters">
                clear filters
            </button>
        </div>
        <div>
            <table v-if="selectedMateria != -1 && selectedGrado != -1">
                <thead>
                    <tr>
                        <th>Nombre Estudiante</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(s, key) in getEstudiantesPorGrado" :key="key">
                        <td>{{ s.nombre_completo + "(" + s.id + ")" }}</td>
                        <td>
                            <input type="number" name="notas"
                                :value="notas[selectedMateria || 0].grades[selectedGrado || 0].students[key || 0].calificacion"
                                @change="addNota(key, s.id, $event.target.value)">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button class="flex items-center px-6 py-2 rounded bg-indigo-500 text-white mx-auto"
            :class="{ 'bg-indigo-300': selectedGrado == -1 || selectedMateria == -1 }" v-on:click="sendNotas"
            :disabled="selectedGrado == -1 || selectedMateria == -1">
            Enviar notas
        </button>
    </div>
</template>
