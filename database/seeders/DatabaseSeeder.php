<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::factory()->create([
            'name' => 'Administrador'
        ]);
        Role::factory()->create([
            'name' => 'Auxiliar'
        ]);
        Role::factory()->create([
            'name' => 'Cajero'
        ]);
        Role::factory()->create([
            'name' => 'Gerente'
        ]);
        Role::factory()->create([
            'name' => 'Supervisor'
        ]);

        User::factory(10)->create();

    }
}
