<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Especialidad;

class MedicoSeeder extends Seeder
{
    public function run()
    {
        // Crear especialidades
        $especialidades = [
            'Cardiología',
            'Dermatología',
            'Pediatría',
            'Neurología',
            'Ginecología'
        ];

        foreach ($especialidades as $nombre) {
            Especialidad::create(['nombre' => $nombre]);
        }

        // Crear médicos y asociarlos con especialidades
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "Médico $i",
                'email' => "medico$i@example.com",
                'password' => "medico$i", // En un entorno real, usar Hash::make()
                'rol' => 'medico',
                'telefono' => "+51 9$i$i$i$i$i$i$i$i$i",
            ]);

            $medico = Doctor::create([
                'usuario_id' => $user->id,
                'codigo_cmp' => "CMP$i$i$i$i",
            ]);

            // Asociar especialidades aleatorias
            $especialidadesIds = Especialidad::inRandomOrder()->take(2)->pluck('id');
            $medico->especialidades()->sync($especialidadesIds);
        }
    }
}