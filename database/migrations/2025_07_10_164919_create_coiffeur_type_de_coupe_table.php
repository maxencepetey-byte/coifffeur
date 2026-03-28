<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coiffeur_type_de_coupe', function (Blueprint $table) {
    $table->id();
    $table->foreignId('coiffeur_id')->constrained('coiffeurs')->onDelete('cascade');
    $table->foreignId('type_de_coupe_id')->constrained('types_de_coupes')->onDelete('cascade');
    $table->timestamps();

    $table->unique(['coiffeur_id', 'type_de_coupe_id']); // Pour éviter doublons
});

    }

    public function down(): void
    {
        Schema::dropIfExists('coiffeur_type_de_coupe');
    }
};

