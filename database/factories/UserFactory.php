<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'apellido1' => $this->faker->lastName,
            'apellido2' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('1234'), // Puedes cambiar esto por una contraseña segura
            'sexo' => $this->faker->numberBetween(0, 1), // O ajusta esto según tu lógica de aplicación
            'role' => $this->faker->randomElement(['secretaria', 'doctor']), // Ajusta esto según los roles disponibles
            'especialidad' => $this->faker->randomElement(['Cardiología', 'Neurología', 'Pediatría']), // Ajusta esto según las especialidades disponibles
            'consultorio' => $this->faker->randomElement(['A101', 'B202', 'C303']), // Ajusta esto según los consultorios disponibles
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
