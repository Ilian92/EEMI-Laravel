<?php
namespace App\Http\Controllers;

use App\Models\User;

class FeedController extends Controller
{
    public function index()
    {
        $topCreators = User::where('is_creator', true)
            ->with([
                'posts' => function ($query) {
                    $query->latest()->take(3);
                }
            ])
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('feed.index', compact('topCreators'));
    }
}
