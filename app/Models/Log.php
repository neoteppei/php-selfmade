<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    
    protected $fillable = [
        'dive_date',
        'experience_number',
        'dive_location',
        'dive_point',
        'dive_type',
        'weather',
        'temperature',
        'wind_direction',
        'wave_height',
        'swell',
        'current',
        'low_tide_time',
        'high_tide_time',
        'cylinder_type',
        'equipment_type',
        'entry_time',
        'exit_time',
        'dive_duration',
        'max_depth',
        'avg_depth',
        'water_temp',
        'visibility',
        'start_pressure',
        'end_pressure',
        'memo',
        'photo_path',
        'buddy_signature',
        'instructor_signature'
    ];
}
