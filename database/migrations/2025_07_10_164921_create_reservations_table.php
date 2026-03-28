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
       Schema::create('reservations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
    $table->foreignId('coiffeur_id')->constrained('coiffeurs')->onDelete('cascade');
    $table->foreignId('type_de_coupe_id')->constrained('types_de_coupes')->onDelete('cascade');
    $table->foreignId('statut_id')->constrained('statuts_reservation')->onDelete('restrict');
    $table->dateTime('date_heure');
    $table->timestamps();
});
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
