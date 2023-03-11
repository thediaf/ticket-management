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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('owner');
            $table->foreign('owner')->references('id')->on('users');
            $table->unsignedBigInteger('assigned')->nullable();
            $table->foreign('assigned')->references('id')->on('users');
            $table->enum('state', ['REÇU', 'EN COURS', 'EN ATTENTE', 'NE PAS TRAITER', 'TERMINÉ', 'CLÔTURÉ'])->default('REÇU');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
