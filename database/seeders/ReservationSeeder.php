<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        DB::table('reservations')->insert([
    [
        'client_id' => 1,
        'coiffeur_id' => 1,   // Remplacé 6 par 1
        'type_de_coupe_id' => 2,
        'statut_id' => 1,
        'date_heure' => '2025-07-15 10:00:00',
        'created_at' => now(),
        'updated_at' => now(),
    ],

    [
        'client_id' => 2,
        'coiffeur_id' => 2,   // Remplacé 5 par 2
        'type_de_coupe_id' => 1,
        'statut_id' => 2,
        'date_heure' => '2025-07-16 14:30:00',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'client_id' => 3,
        'coiffeur_id' => 3,   // Remplacé 4 par 3
        'type_de_coupe_id' => 3,
        'statut_id' => 3,
        'date_heure' => '2025-07-17 09:00:00',
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);

    }
}
