<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Cambia 'password' por la contraseña deseada
            'role' => 'admin', // Asegúrate de tener el campo 'role' en tu tabla 'users'
        ]);

        \App\Models\User::create([
            'name' => 'student 1',
            'email' => 'student1@example.com',
            'password' => bcrypt('password'), // Cambia 'password' por la contraseña deseada
            'role' => 'student', // Asegúrate de tener el campo 'role' en tu tabla 'users'
        ]);
        \App\Models\User::create([
            'name' => 'student 2',
            'email' => 'student2@example.com',
            'password' => bcrypt('password'), // Cambia 'password' por la contraseña deseada
            'role' => 'student', // Asegúrate de tener el campo 'role' en tu tabla 'users'
        ]);
        \App\Models\User::create([
            'name' => 'student 3',
            'email' => 'student3@example.com',
            'password' => bcrypt('password'), // Cambia 'password' por la contraseña deseada
            'role' => 'student', // Asegúrate de tener el campo 'role' en tu tabla 'users'
        ]);
        \App\Models\User::create([
            'name' => 'student 4',
            'email' => 'student4@example.com',
            'password' => bcrypt('password'), // Cambia 'password' por la contraseña deseada
            'role' => 'student', // Asegúrate de tener el campo 'role' en tu tabla 'users'
        ]);
    }
}
