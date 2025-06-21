<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/Onlyfeets');
        }

        $totalMembers = User::count();
        $totalCreators = User::where('is_creator', true)->count();

        $totalSubscriptions = Subscription::count();
        $activeSubscriptions = Subscription::where('is_active', true)->count();
        $satisfactionRate = $totalSubscriptions > 0 ?
            round(($activeSubscriptions / $totalSubscriptions) * 100) : 98;

        return view('homepage', compact(
            'totalMembers',
            'totalCreators',
            'satisfactionRate'
        ));
    }
}
