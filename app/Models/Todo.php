<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['name', 'created_by'];

    public function createdBy(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
