<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grade_subject', function (Blueprint $table) {
            $table->foreignId('grade_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->integer('unidad_pedagogica')->nullable();
            $table->integer('periodo')->nullable();
            $table->integer('horas_clase')->nullable();
        });
        $primer_grado = \App\Models\Grade::find(1);
        $primer_grado->subjects()->sync([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 14]);
        $segundo_grado = \App\Models\Grade::find(2);
        $segundo_grado->subjects()->sync([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 14]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_subject');
    }
};
