<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UtilisateurSeeder extends Seeder
{
    public function run()
    {
        DB::table('utilisateurs')->insert([
            [
                'prenom' => 'Alice',
                'nom' => 'Dupont',
                'email' => 'alice@example.com',
                'mot_de_passe' => Hash::make('password123'),
                'role' => 'coiffeur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'prenom' => 'Bob',
                'nom' => 'Martin',
                'email' => 'bob@example.com',
                'mot_de_passe' => Hash::make('password123'),
                'role' => 'coiffeur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'prenom' => 'Charlie',
                'nom' => 'Durand',
                'email' => 'charlie@example.com',
                'mot_de_passe' => Hash::make('password123'),
                'role' => 'coiffeur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'prenom' => 'Maxence',
                'nom' => 'Petey',
                'email' => 'maxence@example.com',
                'mot_de_passe' => Hash::make('password123'),
                'role' => 'client',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'prenom' => 'Vini',
                'nom' => 'Vini',
                'email' => 'vini@example.com',
                'mot_de_passe' => Hash::make('password123'),
                'role' => 'client',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'prenom' => 'Lee',
                'nom' => 'Lee',
                'email' => 'lee@example.com',
                'mot_de_passe' => Hash::make('password123'),
                'role' => 'client',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
