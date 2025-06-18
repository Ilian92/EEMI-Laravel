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
}
