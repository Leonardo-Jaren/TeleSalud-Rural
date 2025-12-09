<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $especialidades = [
            [
                'nombre' => 'Medicina General',
                'descripcion' => 'Atención médica integral y preventiva para toda la familia'
            ],
            [
                'nombre' => 'Pediatría',
                'descripcion' => 'Atención especializada para niños y adolescentes'
            ],
            [
                'nombre' => 'Cardiología',
                'descripcion' => 'Diagnóstico y tratamiento de enfermedades del corazón'
            ],
            [
                'nombre' => 'Ginecología',
                'descripcion' => 'Salud reproductiva y atención a la mujer'
            ],
            [
                'nombre' => 'Traumatología',
                'descripcion' => 'Tratamiento de lesiones del sistema musculoesquelético'
            ],
            [
                'nombre' => 'Dermatología',
                'descripcion' => 'Diagnóstico y tratamiento de enfermedades de la piel'
            ],
            [
                'nombre' => 'Oftalmología',
                'descripcion' => 'Atención especializada en salud visual'
            ],
            [
                'nombre' => 'Psiquiatría',
                'descripcion' => 'Salud mental y tratamiento de trastornos psicológicos'
            ],
            [
                'nombre' => 'Neurología',
                'descripcion' => 'Diagnóstico y tratamiento del sistema nervioso'
            ],
            [
                'nombre' => 'Medicina Interna',
                'descripcion' => 'Atención integral de adultos con enfermedades complejas'
            ],
        ];

        foreach ($especialidades as $especialidad) {
            Especialidad::firstOrCreate(
                ['nombre' => $especialidad['nombre']],
                ['descripcion' => $especialidad['descripcion']]
            );
        }
    }
}
