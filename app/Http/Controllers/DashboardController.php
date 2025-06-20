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
        $user  = Auth::user();
        $start = Carbon::now()->subMonths(11)->startOfMonth();
        $labels = $subsData = $revenueData = [];

        for ($i = 0; $i < 12; $i++) {
            $month = $start->copy()->addMonths($i);
            $labels[]      = $month->format('M Y');
            $subsData[]    = Subscription::where('creator_id', $user->id)
                                ->whereYear('created_at', $month->year)
                                ->whereMonth('created_at', $month->month)
                                ->count();
            $revenueData[] = (float) Subscription::where('creator_id', $user->id)
                                ->whereYear('created_at', $month->year)
                                ->whereMonth('created_at', $month->month)
                                ->sum('amount');
        }

        return view('dashboard.stats', compact('labels','subsData','revenueData'));
    }
}