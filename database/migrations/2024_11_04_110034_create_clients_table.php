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
        Schema::create('clienti', function (Blueprint $table) {
            $table->bigIncrements('cid');
            $table->string('nome');
            $table->string('cognome');
            $table->string('cellulare')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('tipo')->nullable();
            $table->string('status'); // Puoi cambiare il valore di default se necessario
            $table->text('note')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Associa il cliente a un utente
            $table->timestamps();
            $table->softDeletes(); // Aggiunge il campo deleted_at per il soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clienti');
    }
};
