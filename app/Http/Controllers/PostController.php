<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = new Post([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'is_published' => true,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image_path = $imagePath;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post créé avec succès');
    }

    public function index()
    {
        $posts = Post::all(); // Récupère tous les posts
        return view('posts.index', compact('posts')); // Retourne la vue avec les posts
    }
}