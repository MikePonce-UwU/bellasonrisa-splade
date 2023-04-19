<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::find(1);
        $user->roles()->sync(Role::all());

        // \App\Models\User::factory()->create([
        //     'name' => 'Mike Ponce',
        //     'email' => 'mike@admin.com',
        //     'password' => bcrypt('123'),
        // ]);
    }
}
