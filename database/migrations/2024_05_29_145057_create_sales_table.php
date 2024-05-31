<?php

use App\Models\{Client, User, Vehicle};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Vehicle::class)->constrained();
            $table->foreignIdFor(Client::class)->constrained();
            $table->string('payment_method');
            $table->string('status');
            $table->date('date_sale');
            $table->date('date_payment');
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('surchange', 10, 2)->default(0);
            $table->decimal('total', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};