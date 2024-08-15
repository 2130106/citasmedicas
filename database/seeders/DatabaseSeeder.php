<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Servicio;
use App\Models\Paciente;
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
            'password' => Hash::make('admin'), 
            'sexo' => 0, 
            'role' => 'admin', 
            'especialidad' => null, 
            'consultorio' => null, 
        ]);

        User::factory()->create([
            'name' => 'JUAN',
            'apellido1' => 'Maldonado',
            'apellido2' => 'Chavez',
            'email' => 'juan@gmail.com',
            'password' => Hash::make('12345678'), 
            'sexo' => 0, 
            'role' => 'doctor', 
            'especialidad' => 'cardiologia', 
            'consultorio' =>'1234', 
        ]);

        User::factory()->create([
            'name' => 'MARIA',
            'apellido1' => 'PEREZ',
            'apellido2' => 'RODRIGUEZ',
            'email' => 'secretara1@gmail.com',
            'password' => Hash::make('12345678'), 
            'sexo' => 1, 
            'role' => 'secretaria', 
            'especialidad' => null, 
            'consultorio' => null, 
        ]);
        // Insertar servicios por defecto
        Servicio::create(['nombre' => 'inyeccion', 'precio' => 25]);
        Servicio::create(['nombre' => 'consulta medica', 'precio' => 50]);
        Servicio::create(['nombre' => 'medicamento', 'precio' => 200]);
        Servicio::create(['nombre' => 'consulta psicologica', 'precio' => 30]);
        Servicio::create(['nombre' => 'tiempo extra de consulta', 'precio' => 50]);

        Paciente::create([
            'nombre' => 'Carlos',
            'apellido' => 'Gonzalez',
            'genero' => 'Masculino',
            'fecha_nac' => '1985-06-15',
            'edad' => 38,
            'email' => 'carlos.gonzalez@example.com',
            'telefono' => '555-1234',
        ]);

        Paciente::create([
            'nombre' => 'Ana',
            'apellido' => 'Martinez',
            'genero' => 'Femenino',
            'fecha_nac' => '1990-04-10',
            'edad' => 34,
            'email' => 'ana.martinez@example.com',
            'telefono' => '555-5678',
        ]);

        Paciente::create([
            'nombre' => 'Luis',
            'apellido' => 'Ramirez',
            'genero' => 'Masculino',
            'fecha_nac' => '2000-01-20',
            'edad' => 24,
            'email' => 'luis.ramirez@example.com',
            'telefono' => '555-8765',
        ]);

    }

}
