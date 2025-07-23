<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('posts', $imageName, 'public');
        }

        $post = Post::create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'is_published' => true,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post créé avec succès');
    }

    public function index()
    {
        $posts = Post::with('user')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
        return view('posts.index', compact('posts'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'content' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $imagePath = $post->image_path;

        if ($request->hasFile('image')) {
            $post->deleteImage();

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('posts', $imageName, 'public');
        }

        $post->update([
            'content' => $validated['content'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post mis à jour avec succès');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }
        $post->deleteImage();
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post supprimé avec succès');
    }
}