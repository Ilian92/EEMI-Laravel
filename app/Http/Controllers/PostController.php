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
            'content' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = new Post([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'is_published' => true,
        ]);

        if ($request->hasFile('image')) {
            // Convert image to base64 like in seeder
            $imageContent = file_get_contents($request->file('image')->path());
            $post->image = base64_encode($imageContent);
        }

        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post créé avec succès');
    }
}