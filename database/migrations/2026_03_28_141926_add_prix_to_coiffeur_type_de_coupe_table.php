<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('coiffeur_type_de_coupe', function (Blueprint $table) {
            // On ajoute la colonne 'prix' qui permet d'avoir des prix décimaux (ex: 35.50)
            // On met 'nullable' au cas où un coiffeur n'ait pas encore défini son prix
            $table->decimal('prix', 8, 2)->nullable()->after('type_de_coupe_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coiffeur_type_de_coupe', function (Blueprint $table) {
            $table->dropColumn('prix');
        });
    }
};