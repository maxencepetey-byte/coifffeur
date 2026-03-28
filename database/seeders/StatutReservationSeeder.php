<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatutReservationSeeder extends Seeder
{
    

public function run()
    {
        DB::table('statuts_reservation')->insert([
        ['nom'=>'en attente', 'created_at'=>now(),'updated_at'=>now()],
        ['nom'=>'confirmée',  'created_at'=>now(),'updated_at'=>now()],
        ['nom'=>'annulé',     'created_at'=>now(),'updated_at'=>now()],
        ['nom'=>'terminée',   'created_at'=>now(),'updated_at'=>now()],
        ]);

    }
    
}
