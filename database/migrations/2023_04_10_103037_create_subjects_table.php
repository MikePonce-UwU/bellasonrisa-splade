<?php

use Database\Seeders\SubjectSeeder;
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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_corto');
            $table->string('nombre_largo');
            $table->string('categoria_asignatura')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        $seeder = new SubjectSeeder;
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
