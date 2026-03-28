<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CoiffeurSeeder extends Seeder
{
    public function run()
    {
        DB::table('coiffeurs')->insert([
            [
                'utilisateur_id' => 1,
                'description' => 'Coiffeur spécialisé en coupes modernes et colorations.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'utilisateur_id' => 2,
                'description' => 'Expert en coiffure classique et soins capillaires.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'utilisateur_id' => 3,
                'description' => 'Coiffeur styliste pour événements et mariages.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

