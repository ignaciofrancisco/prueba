<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Juan Pérez',
                'correo' => 'juan@gmail.com',
                'clave' => Hash::make('123')
            ],
            [
                'nombre' => 'María López',
                'correo' => 'maria@gmail.com',
                'clave' => Hash::make('123')
            ],
            [
                'nombre' => 'Carlos Ruiz',
                'correo' => 'carlos@gmail.com',
                'clave' => Hash::make('123')
            ],
        ]);
    }
}
