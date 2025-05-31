<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::all();
        return view('todo.index', [
           'todoCount' => Todo::count(),
            'todos' => $todos,
            'user' => Auth::user()
        ]);
    }

    public function add(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3'
        ]);
        Todo::create([
            ...$validated,
            'created_by' => Auth::user()->id
        ]);
        return redirect()->back();
    }

    public function delete(Todo $todo){
        $todo->delete();
        return redirect()->back();
    }

    public function view(Todo $todo){
        return view('todo.view',[
            'todo' => $todo
        ]);
    }

    public function updateform(Todo $todo){
        return view('todo.form',[
           'todo' => $todo
        ]);
    }

    public function update(Todo $todo, Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3'
        ]);
        $todo->name = $validated['name'];
        $todo->save();

       // $todo->update($validated);
        return redirect()->back();
    }
}
