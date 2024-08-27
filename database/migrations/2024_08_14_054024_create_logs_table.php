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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->date('dive_date');
            $table->integer('experience_number');
            $table->string('dive_location');
            $table->string('dive_point')->nullable();
            $table->string('dive_type');
            $table->string('weather');
            $table->integer('temperature');
            $table->string('wind_direction')->nullable()->default('N/A'); 
            $table->string('wave_height')->nullable(); 
            $table->string('swell')->nullable();
            $table->string('current')->nullable(); 
            $table->time('low_tide_time');
            $table->time('high_tide_time');
            $table->string('cylinder_info')->nullable(); 
            $table->string('equipment_info')->nullable(); 
            $table->time('entry_time');
            $table->time('exit_time');
            $table->integer('dive_duration')->nullable(); 
            $table->decimal('max_depth', 5, 2)->nullable(); 
            $table->decimal('avg_depth', 5, 2)->nullable(); 
            $table->integer('water_temp')->nullable(); 
            $table->integer('visibility')->nullable(); 
            $table->integer('start_pressure')->nullable(); 
            $table->integer('end_pressure')->nullable(); 
            $table->text('memo')->nullable(); 
            $table->string('photo_path')->nullable();
            $table->string('buddy_signature')->nullable();
            $table->string('instructor_signature')->nullable();
            $table->string('cylinder_capacity')->nullable(); 
            $table->json('cylinder_type')->nullable(); 
            $table->integer('nitrox_percentage')->nullable(); 
            $table->integer('fabric_thickness')->nullable(); 
            $table->json('equipment_type')->nullable(); 
            $table->string('other_equipment')->nullable(); 
            $table->string('other_accessories')->nullable(); 
            $table->decimal('weight_kg', 5, 2)->nullable(); 
            $table->string('photography_equipment')->nullable(); 
            $table->json('accessory')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};