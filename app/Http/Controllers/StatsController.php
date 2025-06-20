<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
use Carbon\Carbon;

class StatsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $start = Carbon::now()->subMonths(11)->startOfMonth();
        $labels = [];
        $subsData = [];
        $revenueData = [];

        for ($i = 0; $i < 12; $i++) {
            $month = $start->copy()->addMonths($i);
            $labels[] = $month->format('M Y');

            $count = Subscription::where('creator_id', $user->id)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $subsData[] = $count;

            $sum = Subscription::where('creator_id', $user->id)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('amount');
            $revenueData[] = (float) $sum;
        }

        return view('dashboard.stats', compact('labels','subsData','revenueData'));
    }
}