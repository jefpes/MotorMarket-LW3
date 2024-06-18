<?php

use App\Models\{Vehicle, VehicleModel};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->date('purchase_date');
            $table->decimal('purchase_price', places: 2);
            $table->decimal('sale_price', places: 2);
            $table->foreignIdFor(VehicleModel::class)->constrained(table: 'vehicle_models', column: 'id');
            $table->year('year_one');
            $table->year('year_two');
            $table->integer('km');
            $table->string('color');
            $table->string('plate')->unique();
            $table->string('chassi')->unique();
            $table->string('renavan')->unique();
            $table->date('sold_date')->nullable();
            $table->string('description');

            $table->timestamps();
        });

        Schema::create('vehicle_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Vehicle::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('vehicle_photos');
        Schema::dropIfExists('vehicles');
    }
};
