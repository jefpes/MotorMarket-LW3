<?php

use App\Models\City;
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
            $table->string('rg', 20)->unique();
            $table->string('cpf', 20)->unique();
            $table->string('marital_status');
            $table->string('phone_one', 20)->unique();
            $table->string('phone_two', 20)->nullable()->unique();
            $table->date('birth_date');
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->string('affiliated_one')->nullable();
            $table->string('affiliated_two')->nullable();
            $table->string('description')->nullable();

            $table->string('cep', 20);
            $table->string('logradouro_type', 100);
            $table->string('logradouro'); // Rua, Avenida, etc.
            $table->integer('number');
            $table->string('complement')->nullable();
            $table->string('bairro', 100);
            $table->foreignIdFor(City::class)->constrained(table: 'cities', column: 'id');
            $table->string('state', 100); // Pode ser uma abreviação (SP, RJ, etc.)
            $table->string('country', 100)->default('Brasil');

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
