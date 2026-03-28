<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeCoupeSeeder extends Seeder
{
    public function run()
    {
        DB::table('types_de_coupes')->insert([
            [
                'nom' => 'Coupe classique',
                'prix' => 20.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Coupe dégradée',
                'prix' => 25.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Coloration',
                'prix' => 40.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Contour',
                'prix' => 10.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

