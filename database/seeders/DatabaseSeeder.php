<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\Site;
use App\Models\User;
use App\Models\LendType;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create(['name' => 'Administrateur fonctionnel']);
        Role::create(['name' => 'Employé']);
        Role::create(['name' => 'Superieur hierachique']);
        Site::create(['name' => 'Abidjan, Zone 4']);
        Site::create(['name' => 'San Pedro']);

        $department  = Department::create(['name' => 'Direction générale']);

        User::create([
            'identifier' => '123456789',
            'first_name' => 'Admin',
            'last_name' => 'Fonctionnel',
            'contact' => '0123456789',
            'position' => 'Administrateur fonctionnel',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'site_id' => 1,
            'department_id' => 1,
        ]);

        User::create([
            'identifier' => '000000000',
            'first_name' => 'Employe',
            'last_name' => 'Employe',
            'contact' => '0123456789',
            'position' => 'Employe',
            'email' => 'employe@saco.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'site_id' => 1,
            'department_id' => 1,
        ]);

       $manager =  User::create([
            'identifier' => '111111111',
            'first_name' => 'Superieur',
            'last_name' => 'Superieur',
            'contact' => '0123456789',
            'position' => 'Superieur',
            'email' => 'sup@saco.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'site_id' => 1,
            'department_id' => 1,
        ]);

        $department->update(['user_id' => $manager->id]);

        LendType::create([
            'name' => 'Prêt scolaire(12 mois)',
        ]);

        LendType::create([
            'name' => 'Prêt vehicule(60 mois)',
        ]);

        LendType::create([
            'name' => 'Prêt court terme(12 mois)',
        ]);

        LendType::create([
            'name' => 'Prêt long terme(60 mois)',
        ]);
    }
}
