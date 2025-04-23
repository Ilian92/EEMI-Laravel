<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {

        $variable = True;

        $tableau = [1, 2, 4, 6, 8];

        /*
        $todo = new Todo();
        $todo->name = 'Acheter du poisson';
        $todo->save();
        */

        $todos = Todo::all();

        return view('todo.index', [
            'todoCount' => Todo::count(),
            'todos' => $todos
        ]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3'
        ]);

        Todo::create($validated);

        // $todo = new Todo();
        // $todo->name = $request->name;
        // $todo->save();
        return redirect()->back();
    }

    public function delete(Todo $todo)
    {
        $todo->delete();
        return redirect()->back();
    }

    public function view(Todo $todo)
    {
        return view(
            'todo.view',
            [
                'todo' => $todo
            ]
        );
    }

    public function updateform(Todo $todo)
    {
        return view(
            'todo.form',
            [
                'todo' => $todo
            ]
        );
    }

    public function update(Request $request, Todo $todo)
    {
        $validated = $request->validate([
            'name' => 'required|min:3'
        ]);

        $todo->name = $validated['name'];
        $todo->save();

        return redirect()->back();
    }
}
