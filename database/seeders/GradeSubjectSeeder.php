<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $primer_grado = \App\Models\Grade::find(1);
        $primer_grado->subjects()->sync([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 14]);
        $segundo_grado = \App\Models\Grade::find(2);
        $segundo_grado->subjects()->sync([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 14]);
    }
}
