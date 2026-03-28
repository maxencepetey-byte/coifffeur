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
      Schema::create('disponibilites', function (Blueprint $table) {
    $table->id();
    $table->foreignId('coiffeur_id')->constrained('coiffeurs')->onDelete('cascade');
    $table->dateTime('debut');
    $table->dateTime('fin');
    $table->timestamps();
});
    }





    /**
     * Reverse the migrations.
     */
    public function down(): void{
    {
        Schema::dropIfExists('disponibilites');
    }
}
};
