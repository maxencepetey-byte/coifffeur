<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ordre important : utilisateurs avant clients/coiffeurs, etc.
        $this->call([
            UtilisateurSeeder::class,
            ClientSeeder::class,
            CoiffeurSeeder::class,
            TypeCoupeSeeder::class,
            CoiffeurTypeDeCoupeSeeder::class,
            StatutReservationSeeder::class,
            DisponibiliteSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}

