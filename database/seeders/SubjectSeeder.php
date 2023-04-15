<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::create(['nombre_corto' => 'CREV', 'nombre_largo' => 'creciendo en valores', 'categoria_asignatura' => 'desarrollo personal social y emocional']);
        Subject::create(['nombre_corto' => 'DDM', 'nombre_largo' => 'derechos y dignidad de las mujeres', 'categoria_asignatura' => 'desarrollo personal social y emocional']);
        Subject::create(['nombre_corto' => 'AEP', 'nombre_largo' => 'educación para aprender, emprender y prosperar', 'categoria_asignatura' => 'desarrollo personal social y emocional']);
        Subject::create(['nombre_corto' => 'EESS', 'nombre_largo' => 'estudios sociales (historia, geografía)', 'categoria_asignatura' => 'desarrollo personal social y emocional']);
        Subject::create(['nombre_corto' => 'HIS', 'nombre_largo' => 'historia', 'categoria_asignatura' => 'desarrollo personal social y emocional']);
        Subject::create(['nombre_corto' => 'GEO', 'nombre_largo' => 'geografía', 'categoria_asignatura' => 'desarrollo personal social y emocional']);
        Subject::create(['nombre_corto' => 'ECO', 'nombre_largo' => 'economía', 'categoria_asignatura' => 'desarrollo personal social y emocional']);
        Subject::create(['nombre_corto' => 'SOC', 'nombre_largo' => 'sociología', 'categoria_asignatura' => 'desarrollo personal social y emocional']);
        Subject::create(['nombre_corto' => 'FIL', 'nombre_largo' => 'filosofía', 'categoria_asignatura' => 'desarrollo personal social y emocional']);
        Subject::create(['nombre_corto' => 'EFPD', 'nombre_largo' => 'educación física y práctiva deportiva', 'categoria_asignatura' => 'desarrollo personal social y emocional']);
        Subject::create(['nombre_corto' => 'LYL', 'nombre_largo' => 'lengua y literatura', 'categoria_asignatura' => 'desarrollo de las habilidades de la comunicación y el talento artístico y cultural']);
        Subject::create(['nombre_corto' => 'LEX', 'nombre_largo' => 'lengua extranjera (inglés, francés)', 'categoria_asignatura' => 'desarrollo de las habilidades de la comunicación y el talento artístico y cultural']);
        Subject::create(['nombre_corto' => 'TAC', 'nombre_largo' => 'talleres de arte y cultura', 'categoria_asignatura' => 'desarrollo de las habilidades de la comunicación y el talento artístico y cultural']);
        Subject::create(['nombre_corto' => 'MAT', 'nombre_largo' => 'matemáticas', 'categoria_asignatura' => 'desarrollo del pensamiento lógico y científico']);
        Subject::create(['nombre_corto' => 'CCNN', 'nombre_largo' => 'ciencias naturales (ciencias de la vida y del ambiente)', 'categoria_asignatura' => 'desarrollo del pensamiento lógico y científico']);
        Subject::create(['nombre_corto' => 'QUI', 'nombre_largo' => 'química', 'categoria_asignatura' => 'desarrollo del pensamiento lógico y científico']);
        Subject::create(['nombre_corto' => 'FIS', 'nombre_largo' => 'física', 'categoria_asignatura' => 'desarrollo del pensamiento lógico y científico']);
        Subject::create(['nombre_corto' => 'BIO', 'nombre_largo' => 'biología', 'categoria_asignatura' => 'desarrollo del pensamiento lógico y científico']);
        Subject::create(['nombre_corto' => 'CMM', 'nombre_largo' => 'conociendo mi mundo', 'categoria_asignatura' => 'desarrollo del pensamiento lógico y científico']);
    }
}
