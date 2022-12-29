<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('plate', 60);
            $table->string('color', 30);
            $table->string('brand', 50);
            $table->foreignId('owner_id')->constrained('owners');
            $table->foreignId('driver_id')->constrained('drivers');
            $table->foreignId('type_vehicle_id')->constrained('type_vehicles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
