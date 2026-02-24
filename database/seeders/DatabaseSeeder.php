<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Empresa;
use App\Models\Candidato;
use App\Models\Sector;
use App\Models\Puesto;
use App\Models\Modalidad;
use App\Models\Oferta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Limpieza de tablas respetando claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Oferta::truncate();
        Empresa::truncate();
        Candidato::truncate();
        Sector::truncate();
        Puesto::truncate();
        Modalidad::truncate();
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $passwordHasheada = Hash::make('123456');

        // 2. Crear Datos Maestros
        $modalidades = ['Presencial', 'Remoto', 'Híbrido'];
        foreach ($modalidades as $m) Modalidad::create(['nombre' => $m]);

        $sectores = ['Tecnología', 'Marketing Digital', 'Recursos Humanos', 'Sanidad', 'Ingeniería'];
        foreach ($sectores as $s) Sector::create(['nombre' => $s]);

        $puestos = ['Fullstack Developer', 'Social Media Manager', 'Talent Scout', 'Analista Cloud', 'Project Manager'];
        foreach ($puestos as $p) Puesto::create(['nombre' => $p]);

        // 3. Crear Empresas
        $empresasData = [
            [
                'nombre' => 'Indra Sistemas',
                'cif' => 'A1234567B',
                'ciudad' => 'Madrid',
                'web' => 'https://www.indracompany.com',
                'direccion' => 'Av. de Bruselas, 35',
                'cp' => '28108'
            ],
            [
                'nombre' => 'TechNova Solutions',
                'cif' => 'B98765432',
                'ciudad' => 'Barcelona',
                'web' => 'https://technova.io',
                'direccion' => 'Carrer de la Marina, 12',
                'cp' => '08005'
            ],
            [
                'nombre' => 'Global Marketing SL',
                'cif' => 'C11223344',
                'ciudad' => 'Valencia',
                'web' => 'https://globalmarketing.es',
                'direccion' => 'Plaza del Ayuntamiento, 5',
                'cp' => '46002'
            ],
        ];

        foreach ($empresasData as $index => $data) {
            $empresa = Empresa::create([
                'nombre' => $data['nombre'],
                'cif' => $data['cif'],
                'ciudad' => $data['ciudad'],
                'direccion' => $data['direccion'],
                'cp' => $data['cp'],
                'provincia' => $data['ciudad'],
                'web' => $data['web'],
                'email_contacto' => "rrhh@company" . ($index + 1) . ".com",
                'persona_contacto' => 'Persona de RRHH ' . ($index + 1),
                'telefono' => '91000000' . $index,
                'verificada' => 1
            ]);

            User::create([
                'name' => $data['nombre'] . " Admin",
                'email' => "empresa" . ($index + 1) . "@test.com",
                'password' => $passwordHasheada,
                'role' => 'empresa',
                'empresa_id' => $empresa->id
            ]);

            // 4. Crear Ofertas Detalladas (2 por empresa)
            for ($i = 0; $i < 2; $i++) {
                Oferta::create([
                    'idempresa' => $empresa->id,
                    'idsector' => Sector::inRandomOrder()->first()->id,
                    'idmodalidad' => Modalidad::inRandomOrder()->first()->id,
                    'idpuesto' => Puesto::inRandomOrder()->first()->id,
                    'titulo' => ($i % 2 == 0 ? 'Senior ' : 'Junior ') . Puesto::inRandomOrder()->first()->nombre,
                    'descripcion' => 'Estamos buscando un perfil apasionado para integrarse en nuestro departamento central. Trabajará en proyectos internacionales con las últimas tecnologías del mercado.',
                    'requisitos' => "- Experiencia mínima demostrable.\n- Conocimientos avanzados en el área.\n- Capacidad de trabajo en equipo.\n- Nivel de inglés B2 o superior.",
                    'funciones' => "- Desarrollo y mantenimiento de aplicaciones.\n- Reporte directo al responsable de área.\n- Colaboración en el diseño de nuevas funcionalidades.",
                    'salario_min' => rand(24000, 30000),
                    'salario_max' => rand(32000, 50000),
                    'tipo_contrato' => 'Indefinido',
                    'jornada' => 'Completa',
                    'ubicacion' => $data['ciudad'],
                    'fecha_publicacion' => now(),
                    'publicar_hasta' => now()->addMonths(2),
                    'fecha_incorporacion' => now()->addWeeks(3),
                    'estado' => 'publicada'
                ]);
            }
        }

        // 5. Usuario Admin
        User::create([
            'name' => 'Admin Global',
            'email' => 'admin@admin.com',
            'password' => $passwordHasheada,
            'role' => 'admin',
        ]);

        // 6. Candidatos detallados
        $provincias = ['Sevilla', 'Málaga', 'Granada'];
        for ($i = 1; $i <= 3; $i++) {
            $candidato = Candidato::create([
                'nombre' => "Candidato" . $i,
                'apellidos' => "Apellido Prueba " . $i,
                'email' => "candidato$i@test.com",
                'password_hash' => $passwordHasheada,
                'dni' => rand(10000000, 99999999) . "X",
                'ciudad' => $provincias[$i - 1],
                'provincia' => $provincias[$i - 1],
                'telefono' => '60000000' . $i,
                'fecha_nacimiento' => '1995-05-15'
            ]);

            User::create([
                'name' => $candidato->nombre . " " . $candidato->apellidos,
                'email' => $candidato->email,
                'password' => $passwordHasheada,
                'role' => 'candidato',
                'candidato_id' => $candidato->id
            ]);
        }
    }
}
