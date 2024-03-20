<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    use HasFactory;

    // Define the properties that are mass assignable
    protected $fillable = ['todo_id', 'content', 'is_completed'];

    // Define the inverse relationship with Todo
    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
