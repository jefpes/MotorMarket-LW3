<?php

use App\Models\Employees;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_one');
            $table->string('phone_two')->nullable();
            $table->string('salary')->nullable();
            $table->string('rg');
            $table->string('cpf');
            $table->timestamps();
        });

        Schema::create('employee_address', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employees::class)->constrained()->cascadeOnDelete();
            $table->string('zip_code');
            $table->string('street');
            $table->string('number');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('complement')->nullable();
            $table->timestamps();
        });

        Schema::create('employee_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employees::class)->constrained()->cascadeOnDelete();
            $table->string('photo_name', 255);
            $table->string('format', 5);
            $table->string('full_path', 255);
            $table->string('path', 255);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_photos');
        Schema::dropIfExists('employee_address');
        Schema::dropIfExists('employees');
    }
};
