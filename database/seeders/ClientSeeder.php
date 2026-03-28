<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    public function run()
    {
        DB::table('clients')->insert([
            'utilisateur_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('clients')->insert([
            'utilisateur_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('clients')->insert([
            'utilisateur_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

