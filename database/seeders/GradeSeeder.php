<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grade::create(['nombre_largo' => 'Primer Grado']);
        Grade::create(['nombre_largo' => 'Segundo Grado']);
        Grade::create(['nombre_largo' => 'Tercer Grado']);
        Grade::create(['nombre_largo' => 'Cuarto Grado']);
        Grade::create(['nombre_largo' => 'Quinto Grado']);
        Grade::create(['nombre_largo' => 'Sexto Grado']);
        Grade::create(['nombre_largo' => 'Séptimo Grado']);
        Grade::create(['nombre_largo' => 'Octavo Grado']);
        Grade::create(['nombre_largo' => 'Noveno Grado']);
        Grade::create(['nombre_largo' => 'Décimo Grado']);
        Grade::create(['nombre_largo' => 'Undécimo Grado']);
        Grade::create(['nombre_largo' => 'Primer Nivel']);
        Grade::create(['nombre_largo' => 'Segundo Nivel']);
        Grade::create(['nombre_largo' => 'Tercer Nivel']);
    }
}
