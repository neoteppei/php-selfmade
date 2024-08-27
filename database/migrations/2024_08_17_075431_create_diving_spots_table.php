<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Creatediving_spotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diving_spots', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->decimal('temperature', 5, 2)->nullable();
            $table->integer('humidity')->nullable();
            $table->integer('pressure')->nullable();
            $table->string('weather_description')->nullable();
            $table->decimal('wind_speed', 5, 2)->nullable();
            $table->integer('wind_direction')->nullable();
            $table->decimal('sea_level_pressure', 5, 2)->nullable();
            $table->decimal('ground_level_pressure', 5, 2)->nullable();
            $table->decimal('temp_min', 5, 2)->nullable();
            $table->decimal('temp_max', 5, 2)->nullable();
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
        Schema::dropIfExists('diving_spots');
    }
}
