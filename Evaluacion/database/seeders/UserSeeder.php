<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'nombre' => 'Javier',
            'email' => 'javier@jvcompany.com',
            'telefono' => '123456789',
            'puesto' => 'Trabajador',
            'activo' => true, // booleano
            'password' => Hash::make('123'), // contraseña: 123
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
