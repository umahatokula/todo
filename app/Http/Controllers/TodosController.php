<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;

class TodosController extends Controller
{
    // Fetch all Todos
    public function index()
    {
        $todos = Todo::with('items')->get();

        return inertia('Todos/Index', [
            'todos' => $todos,
        ]);
    }

    // Create a new Todo
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'items' => 'required|array',
            'items.*.content' => 'required|string|max:255',
            'items.*.is_completed' => 'sometimes|boolean'
        ]);

        // Create the Todo
        $todo = Todo::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'] ?? null,
        ]);

        // Loop through each item and create it using the relation
        foreach ($validatedData['items'] as $item) {
            $todo->items()->create([
                'content' => $item['content'],
                'is_completed' => $item['is_completed'] ?? false,
            ]);
        }

        return redirect('/');
    }

    // Show a specific Todo
    public function show(Todo $todo)
    {
        return new TodoResource($todo);
    }

    // Update a specific Todo
    public function update(Request $request, Todo $todo)
    {
        $todo->update($request->all());
        return new TodoResource($todo);
    }

    // Delete a specific Todo
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(null, 204); // No content
    }
}
