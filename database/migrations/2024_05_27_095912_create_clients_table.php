<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rg')->unique();
            $table->string('cpf')->unique();
            $table->string('phone_one')->unique();
            $table->string('phone_two')->nullable()->unique();
            $table->date('birth_date');
            $table->string('affiliated_one')->nullable();
            $table->string('affiliated_two')->nullable();
            $table->string('affiliated_three')->nullable();

            $table->string('cep');
            $table->string('logradouro'); // Rua, Avenida, etc.
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado'); // Pode ser uma abreviação (SP, RJ, etc.)
            $table->string('pais')->default('Brasil');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
