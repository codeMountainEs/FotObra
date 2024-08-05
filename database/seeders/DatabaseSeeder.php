<?php

namespace Database\Seeders;

use App\Models\Obra;
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

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@fotobra.com',
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
