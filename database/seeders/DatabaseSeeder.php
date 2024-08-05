<?php

namespace Database\Seeders;

use App\Models\Obra;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Oficina']);
        Role::create(['name' => 'Jefe de Obra']);

        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'administrador@fotobra.com',
            'role_id' => '1'
        ]);
        User::factory()->create([
            'name' => 'Oficina',
            'email' => 'oficina@fotobra.com',
            'role_id' => '2'
        ]);
        User::factory()->create([
            'name' => 'Jefe de Obra',
            'email' => 'jefedeobra@fotobra.com',
            'role_id' => '3'
        ]);

        Obra::factory()->create([
            'nombre' => 'Chalet Madrid',
            'referencia' => 'CHA-MA-001',
            'localidad' => 'Pozuelo'
        ]);
        Obra::factory()->create([
            'nombre' => 'RESTAURANTE ',
            'referencia' => 'RES-SA-001',
            'Localidad' => 'Santoña'

        ]);
    }
}
