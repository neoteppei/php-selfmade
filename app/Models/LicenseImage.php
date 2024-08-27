<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseImage extends Model
{
    use HasFactory;

    protected $fillable = ['license_id', 'image_path'];

    public function license()
    {
        return $this->belongsTo(License::class);
    }
}