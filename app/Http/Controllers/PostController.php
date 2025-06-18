<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|min:3'
        ]);

        Post::create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'is_published' => true
        ]);

        return redirect()->route('dashboard')->with('success', 'Post créé avec succès');
    }
}