<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Modalidad;

class ModalidadSeeder extends Seeder
{
    public function run(): void
    {
        $modalidades = [
            'Presencial',
            'Híbrido',
            'Teletrabajo',
        ];

        foreach ($modalidades as $nombre) {
            Modalidad::create(['nombre' => $nombre]);
        }
    }
}
