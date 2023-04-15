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
        Schema::create('student_subject', function (Blueprint $table) {
            $table->integer('grade_student');
            $table->foreignId('subject_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->integer('nota_i_corte')->nullable();
            $table->integer('nota_ii_corte')->nullable();
            $table->integer('nota_iii_corte')->nullable();
            $table->integer('nota_iv_corte')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stundet_subject');
    }
};
