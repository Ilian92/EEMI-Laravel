<?php

//namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

//class Post extends Model
//{
// protected $fillable = [
//     'user_id',
//     'content',
//     'is_published',
//     'image',
//     'created_at',
//     'updated_at'
// ];

// protected $casts = [
//     'is_published' => 'boolean',
//     'created_at' => 'datetime',
//     'updated_at' => 'datetime'
// ];

// public function user()
// {
//     return $this->belongsTo(User::class);
// }
//}

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'content',
        'is_published',
        'image_path', // Changé de 'image' à 'image_path'
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor pour obtenir l'URL complète de l'image
    public function getImageUrlAttribute()
    {
        return $this->image_path ? Storage::url($this->image_path) : null;
    }

    // Méthode pour supprimer l'image du stockage
    public function deleteImage()
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            Storage::disk('public')->delete($this->image_path);
        }
    }
}