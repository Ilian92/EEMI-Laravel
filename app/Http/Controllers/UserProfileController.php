<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        if (!$user->is_creator) {
            abort(404, 'Ce profil n\'est pas accessible.');
        }

        $isSubscribed = false;
        if (Auth::check()) {
            $isSubscribed = Auth::user()->isSubscribedTo($user);
        }

        $subscribersCount = $user->subscribers()->where('is_active', true)->count();

        return view('user-profile.show', compact(
            'user',
            'isSubscribed',
            'subscribersCount'
        ));
    }

    public function subscribe(User $creator)
    {
        $user = Auth::user();

        if (!$creator->is_creator) {
            return back()->with('error', __('Cet utilisateur n\'est pas un créateur.'));
        }

        if ($user->id === $creator->id) {
            return back()->with('error', __('Vous ne pouvez pas vous abonner à vous-même.'));
        }

        if ($user->isSubscribedTo($creator)) {
            return back()->with('error', __('Vous êtes déjà abonné à ce créateur.'));
        }

        $user->subscriptions()->updateOrCreate(
            ['creator_id' => $creator->id],
            [
                'amount'     => $creator->subscription_price,
                'expires_at' => now()->addMonth(),
                'is_active'  => true,
            ]
        );

        return back()->with('success', __('Abonnement réussi !'));
    }

    public function unsubscribe(User $creator)
    {
        $user = Auth::user();

        if (!$creator->is_creator) {
            return back()->with('error', __('Cet utilisateur n\'est pas un créateur.'));
        }

        $subscription = $user->subscriptions()
            ->where('creator_id', $creator->id)
            ->where('is_active', true)
            ->first();

        if ($subscription) {
            $subscription->update(['is_active' => false]);
            return back()->with('success', __('Désabonnement réussi.'));
        }

        return back()->with('error', __('Aucun abonnement actif trouvé.'));
    }
}
