<script setup>
import { inject, ref } from 'vue';
const Splade = inject("$splade");

/**
 * props
 */
const { materias } = defineProps({
    materias: [],
});

/**
 * 
 * variables tuanis
 */
const selectedMateria = ref(-1);
const selectedGrado = ref(-1);

const subjects = ref(materias);
const grades = ref([]);
const students = ref([]);


const notas = ref([]);

/**
 * funciones
 */
const addNota = (key, calificacion) => {
    let nota = {
        _id: key,
        materia_id: subjects[selectedMateria.value].id,
        nota: {
            grado_id: subjects[selectedMateria.value].grades[selectedGrado.value].id,
            estudiante_id: s.id,
            nota: calificacion
        },
    };
    notas.push(nota);
    // notas = ['student_id': estudianteId, 'subject_id': materiaId, 'calificacion': calificacion];
    console.log(notas.value);
}
const getGradosPorMateria = (val) => {
    selectedMateria.value = val;
    grades.value = subjects[val].grades;
    console.log(grades.value);
}
const getEstudiantesPorGrado = (val) => {
    selectedGrado.value = val;
    students.value = subjects[selectedMateria.value].grades[val].students;
    console.log(students.value);
}
const sendNotas = () => {
    if (notas.length == 0 || notas == null) {
        console.log('primero añada notas a la sabana...')
    } else {
        console.log('enviando notas...');
        // Splade.emit('addNota', notas);
        Splade.visit('/calificaciones');
    }
}
const clearFilters = () => {
    selectedGrado.value = -1;
    selectedMateria.value = -1;
    subjects.value = null;
    grades.value = null;
    students.value = null;
    subjects.value = materias;
}

</script>
<template>
    <!-- <button @click="count++">{{ count }}</button> -->
    <div>
        <div>
            <select name="subjects" id="subjects" v-on:change="getGradosPorMateria($event.target.value)">
                <option value="-1" selected disabled>--- Seleccione una de las opciones ---</option>
                <template v-for="(m, key) in subjects" :key="m.id">
                    <option :value="key">{{ m.nombre_corto + "(" + m.id + ")" }}</option>
                </template>
            </select>
            <select name="grades" id="grades" v-show="selectedMateria != -1"
                v-on:change="getEstudiantesPorGrado($event.target.value)">
                <option value="-1" selected disabled>--- Seleccione una de las opciones ---</option>
                <template v-for="(g, key) in grades" :key="key">
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
                    <tr v-for="(s, key) in students" :key="key">
                        <td>{{ s.nombre_completo + "(" + s.id + ")" }}</td>
                        <td>
                            <input type="number" name="notas" @input="addNota(key, $event.target.value)">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button class="flex items-center px-6 py-2 rounded bg-indigo-500 text-white mx-auto" v-on:click="sendNotas">
            Enviar notas
        </button>
    </div>
</template>
