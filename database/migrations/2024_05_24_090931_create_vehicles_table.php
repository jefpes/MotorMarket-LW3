<?php

use App\Models\{Vehicle, VehicleModel, VehicleType};
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
            $table->foreignIdFor(VehicleType::class)->constrained();
            $table->foreignIdFor(VehicleModel::class)->constrained();
            $table->year('year_one');
            $table->year('year_two');
            $table->integer('KM');
            $table->string('color');
            $table->string('plate');
            $table->string('chassi');
            $table->string('renavam');
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
