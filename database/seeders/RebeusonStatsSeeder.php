<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RebeusonStatsSeeder extends Seeder
{
    public function run(): void
    {
        // Trouve l'utilisateur "rebeuson"
        $rebeuson = User::where('username', 'rebeuson')->first();

        if (!$rebeuson) {
            $this->command->error('Utilisateur "rebeuson" introuvable');
            return;
        }

        // S'assurer qu'il est créateur
        $rebeuson->update([
            'is_creator' => true,
            'creator_since' => Carbon::now()->subYear(),
            'subscription_price' => 12.99,
            'bio' => 'Créateur de contenu premium sur OnlyFeets',
        ]);

        // Supprimer les anciens abonnements pour éviter les doublons
        Subscription::where('creator_id', $rebeuson->id)->delete();

        // Générer une croissance réaliste sur 12 mois
        $monthlyGrowth = [8, 12, 18, 25, 32, 28, 35, 42, 38, 45, 52, 48];

        foreach ($monthlyGrowth as $index => $newSubsCount) {
            $month = Carbon::now()->subMonths(11 - $index);

            // Créer les nouveaux abonnements pour ce mois
            for ($i = 0; $i < $newSubsCount; $i++) {
                // Générer un email unique en ajoutant un timestamp
                $uniqueEmail = 'subscriber_' . $rebeuson->id . '_' . $index . '_' . $i . '_' . time() . '@example.com';
                $uniqueUsername = 'sub_' . $rebeuson->id . '_' . $index . '_' . $i . '_' . uniqid();

                $subscriber = User::factory()->create([
                    'name' => fake()->name(),
                    'email' => $uniqueEmail,
                    'username' => $uniqueUsername,
                ]);

                // Date aléatoire dans le mois
                $createdAt = $month->copy()->addDays(rand(1, min(28, $month->daysInMonth)));

                Subscription::create([
                    'subscriber_id' => $subscriber->id,
                    'creator_id' => $rebeuson->id,
                    'amount' => $rebeuson->subscription_price,
                    'expires_at' => $createdAt->copy()->addMonth(),
                    'is_active' => rand(1, 10) > 2, // 80% restent actifs
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            // Simuler quelques désabonnements dans les mois suivants
            if ($index > 2) { // Commencer les désabonnements après 3 mois
                $unsubCount = rand(1, 5);
                $existingSubs = Subscription::where('creator_id', $rebeuson->id)
                    ->where('is_active', true)
                    ->where('created_at', '<', $month)
                    ->take($unsubCount)
                    ->get();

                foreach ($existingSubs as $sub) {
                    $sub->update([
                        'is_active' => false,
                        'updated_at' => $month->copy()->addDays(rand(1, 28)),
                    ]);
                }
            }
        }

        $totalSubs = Subscription::where('creator_id', $rebeuson->id)->count();
        $activeSubs = Subscription::where('creator_id', $rebeuson->id)->where('is_active', true)->count();

        $this->command->info("Statistiques créées pour 'rebeuson' :");
        $this->command->info("- Total abonnements : {$totalSubs}");
        $this->command->info("- Abonnements actifs : {$activeSubs}");
        $this->command->info("- Revenus générés : " . number_format($totalSubs * $rebeuson->subscription_price, 2) . "€");
    }
}
