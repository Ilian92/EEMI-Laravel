<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomepageController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        $totalMembers = User::count();
        $totalCreators = User::where('is_creator', true)->count();
        $totalSubscriptions = Subscription::count();
        $activeSubscriptions = Subscription::where('is_active', true)->count();
        $satisfactionRate = $totalSubscriptions > 0 ?
            round(($activeSubscriptions / $totalSubscriptions) * 100) : 98;

        // Top 5 créateurs avec nombre d'abonnés et leurs 3 derniers posts
        $topCreators = User::where('is_creator', true)
            ->withCount('subscribers')
            ->with([
                'posts' => function ($query) {
                    $query->latest()->take(1);
                }
            ])
            ->orderByDesc('subscribers_count')
            ->take(3)
            ->get();

        $isSubscribed = false;
        if (Auth::check()) {
            $isSubscribed = Auth::user()->isSubscribedTo($user);
        }

        return view('homepage', compact(
            'totalMembers',
            'totalCreators',
            'satisfactionRate',
            'topCreators',
            'isSubscribed',
        ));
    }


}
