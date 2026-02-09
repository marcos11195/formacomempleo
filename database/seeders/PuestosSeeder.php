<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Puesto;

class PuestosSeeder extends Seeder
{
    public function run(): void
    {
        $puestos = [
            'Programador PHP',
            'Camarero',
            'Administrativo',
            'Soldador',
            'Técnico de mantenimiento',
            'Dependiente',
            'Enfermero',
            'Profesor',
        ];

        foreach ($puestos as $nombre) {
            Puesto::create(['nombre' => $nombre]);
        }
    }
}
