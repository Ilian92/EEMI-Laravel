<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // Affiche la page principale du dashboard
    public function index()
    {
        return view('dashboard.index');
    }

    // Affiche les abonnements actifs de l’utilisateur
    public function subscriptions()
    {
        $subscriptions = Auth::user()
            ->subscriptions()
            ->where('is_active', true)
            ->with('creator')
            ->paginate(10);

        return view('dashboard.abonnements', compact('subscriptions'));
    }

    // Statistiques pour les créateurs : évolution mensuelle des abonnés et revenus
    public function stats()
    {
        $user = Auth::user();
        $start = Carbon::now()->subMonths(11)->startOfMonth();

        // Données existantes
        $labels = $subsData = $revenueData = $unsubsData = [];

        for ($i = 0; $i < 12; $i++) {
            $month = $start->copy()->addMonths($i);
            $labels[] = $month->format('M Y');

            $newSubs = Subscription::where('creator_id', $user->id)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $subsData[] = $newSubs;

            $revenue = (float) Subscription::where('creator_id', $user->id)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('amount');
            $revenueData[] = $revenue;

            $unsubs = Subscription::where('creator_id', $user->id)
                ->whereYear('updated_at', $month->year)
                ->whereMonth('updated_at', $month->month)
                ->where('is_active', false)
                ->count();
            $unsubsData[] = $unsubs;
        }

        // Nouvelles métriques
        $totalSubscribers = Subscription::where('creator_id', $user->id)
            ->where('is_active', true)
            ->count();

        $totalRevenue = Subscription::where('creator_id', $user->id)->sum('amount');

        $monthlyRevenue = Subscription::where('creator_id', $user->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $avgRevenue = $totalSubscribers > 0 ? $totalRevenue / $totalSubscribers : 0;

        $retentionRate = $totalSubscribers > 0 ?
            (Subscription::where('creator_id', $user->id)
                ->where('is_active', true)
                ->where('created_at', '<', Carbon::now()->subMonth())
                ->count() / $totalSubscribers) * 100 : 0;

        $lastMonthSubs = Subscription::where('creator_id', $user->id)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->count();
        $thisMonthSubs = Subscription::where('creator_id', $user->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        $growthRate = $lastMonthSubs > 0 ?
            (($thisMonthSubs - $lastMonthSubs) / $lastMonthSubs) * 100 : 0;

        $topMonths = collect($labels)
            ->zip($subsData)
            ->map(fn($item) => ['month' => $item[0], 'count' => $item[1]])
            ->sortByDesc('count')
            ->take(3)
            ->values();

        return view('dashboard.stats', compact(
            'labels',
            'subsData',
            'revenueData',
            'unsubsData',
            'totalSubscribers',
            'totalRevenue',
            'monthlyRevenue',
            'avgRevenue',
            'retentionRate',
            'growthRate',
            'topMonths'
        ));
    }
}
