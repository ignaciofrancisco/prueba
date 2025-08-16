<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyectoSeeder extends Seeder
{
    public function run()
    {
        DB::table('proyectos')->insert([
            [
                'nombre' => 'Proyecto x',
                'fecha_inicio' => '2025-06-01',
                'estado' => 'En progreso',
                'responsable' => 'Juan Pérez',
                'monto' => 15000,
                'created_by' => 1
            ],
            [
                'nombre' => 'Proyecto y',
                'fecha_inicio' => '2025-07-15',
                'estado' => 'Finalizado',
                'responsable' => 'María López',
                'monto' => 23000,
                'created_by' => 2
            ],
            [
                'nombre' => 'Proyecto z',
                'fecha_inicio' => '2025-08-01',
                'estado' => 'Pendiente',
                'responsable' => 'Carlos Ruiz',
                'monto' => 12000,
                'created_by' => 3
            ],
        ]);
    }
}
