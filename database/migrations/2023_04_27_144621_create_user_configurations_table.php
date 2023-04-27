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
        Schema::create('user_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->boolean('habilitado')->nullable()->default(false);
            $table->timestamps();
        });

        $users = \App\Models\User::whereDoesntHave('roles', function ($q) {
            return $q->where(['role_id' => [1, 2, 3, 5, 6, 7]]);
        })->get();
        foreach($users as $user){
            \App\Models\UserConfiguration::create(['user_id' => $user->id]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_configurations');
    }
};
