<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisponibiliteSeeder extends Seeder
{
    public function run()
    {
        DB::table('disponibilites')->insert([
            [
                'coiffeur_id' => 1,
                'debut' => '2025-07-10 09:00:00',
                'fin' => '2025-07-10 12:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'coiffeur_id' => 1,
                'debut' => '2025-07-10 14:00:00',
                'fin' => '2025-07-10 18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'coiffeur_id' => 2,
                'debut' => '2025-07-11 10:00:00',
                'fin' => '2025-07-11 16:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'coiffeur_id' => 3,
                'debut' => '2025-07-12 08:00:00',
                'fin' => '2025-07-12 13:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
