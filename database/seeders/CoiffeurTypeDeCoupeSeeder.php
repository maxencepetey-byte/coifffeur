<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoiffeurTypeDeCoupeSeeder extends Seeder
{
    public function run()
    {
        // Exemple de relations entre coiffeurs et types de coupes
        DB::table('coiffeur_type_de_coupe')->insert([
            ['coiffeur_id' => 1, 'type_de_coupe_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['coiffeur_id' => 1, 'type_de_coupe_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['coiffeur_id' => 2, 'type_de_coupe_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['coiffeur_id' => 3, 'type_de_coupe_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['coiffeur_id' => 3, 'type_de_coupe_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

