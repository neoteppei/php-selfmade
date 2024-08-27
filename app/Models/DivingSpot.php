<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivingSpot extends Model
{
    use HasFactory;

    protected $connection = 'mysql_diving_spots';

    protected $fillable = [
        'location', 
        'latitude', 
        'longitude', 
        'temperature', 
        'humidity', 
        'pressure', 
        'weather_description', 
        'wind_speed', 
        'wind_direction', 
        'sea_level_pressure', 
        'ground_level_pressure', 
        'temp_min', 
        'temp_max',
    ];
}