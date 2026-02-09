<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Sector;

class SectoresSeeder extends Seeder
{
    public function run(): void
    {
        $sectores = [
            'Hostelería',
            'Informática',
            'Metal',
            'Construcción',
            'Sanidad',
            'Educación',
            'Comercio',
            'Transporte',
        ];

        foreach ($sectores as $nombre) {
            Sector::create(['nombre' => $nombre]);
        }
    }
}
