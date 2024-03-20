<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // Define the properties that are mass assignable
    protected $fillable = ['title', 'description'];

    // Define the relationship with TodoItem
    public function items()
    {
        return $this->hasMany(TodoItem::class);
    }
}
