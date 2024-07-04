<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       

        User::factory()->create([
            'name' => 'admin',
            'apellido1' => 'admin',
            'apellido2' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'), // Puedes cambiar esto por una contraseña segura
            'sexo' => 0, // Ajusta esto según tu lógica de aplicación
            'role' => 'admin', // Supongamos que el rol 0 es 'admin'. Cambia esto según tu necesidad.
            'especialidad' => null, 
            'consultorio' => null, 
        ]);
    }

}
