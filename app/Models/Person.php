<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';
    protected $fillable = [
        'name',
        'face_photo',
        'feet_photo',
    ];

    public function getFacePhotoUrlAttribute()
    {
        return asset('storage/' . $this->face_photo);
    }

    public function getFeetPhotoUrlAttribute()
    {
        return asset('storage/' . $this->feet_photo);
    }
}