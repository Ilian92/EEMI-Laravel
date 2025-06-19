<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = User::where('is_creator', true)
            ->withCount('subscribers') // compte le nombre d’abonnés
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderByDesc('subscribers_count');

        $creators = $query->paginate(9)->appends(['search' => $search]);

        if ($request->ajax()) {
            return response()->json($creators);
        }

        return view('browse', compact('creators'));
    }

    public function become()
    {
        $user = auth()->user();
        $user->update([
            'is_creator'    => true,
            'creator_since' => now(),
        ]);

        return back()->with('success', 'Vous êtes maintenant créateur de contenu.');
    }

    public function remove()
    {
        $user = auth()->user();
        $user->update([
            'is_creator'    => false,
            'creator_since' => null,
        ]);

        return back()->with('success', 'Vous n\'êtes plus créateur de contenu.');
    }
}
