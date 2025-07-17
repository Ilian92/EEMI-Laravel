<?php
namespace App\Http\Controllers;

use App\Models\User;

class FeedController extends Controller
{
    public function index()
    {
        // Récupérer des créateurs aléatoires avec leurs posts
        $topCreators = User::where('is_creator', true) // filtre créateurs actifs
            ->with([
                'posts' => function ($query) {
                    $query->latest()->take(3); // par exemple, max 3 derniers posts par créateur
                }
            ])
            ->inRandomOrder()
            ->take(5) // par exemple 5 créateurs
            ->get();

        return view('feed.index', compact('topCreators'));
    }
}
