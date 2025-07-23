<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Str;

class GuessController extends Controller
{
    public function index()
    {
        // Sélectionner une personne au hasard pour les pieds à deviner
        $correctPerson = Person::inRandomOrder()->first();

        if (!$correctPerson) {
            return redirect()->back()->with('error', 'Aucune personne trouvée dans la base de données');
        }

        // Sélectionner 2 autres personnes au hasard pour les mauvaises réponses
        $wrongPersons = Person::where('id', '!=', $correctPerson->id)
            ->inRandomOrder()
            ->limit(2)
            ->get();

        // Si pas assez de personnes, retourner une erreur
        if ($wrongPersons->count() < 2) {
            return redirect()->back()->with('error', 'Il faut au moins 3 personnes dans la base de données');
        }

        // Mélanger les 3 personnes pour les choix
        $choices = collect([$correctPerson])->merge($wrongPersons)->shuffle();

        // Traitement des chemins d'images pour la personne correcte
        $correctPerson->feet_photo_url = $this->getImagePath($correctPerson->feet_photo);

        // Traitement des chemins d'images pour tous les choix
        $choices->each(function ($person) {
            $person->face_photo_url = $this->getImagePath($person->face_photo);
        });

        // Gestion du score selon l'état de connexion
        $score = $this->getScore();
        $totalGames = $this->getTotalGames();
        $isLoggedIn = auth()->check();

        return view('guess.index', compact('correctPerson', 'choices', 'score', 'totalGames', 'isLoggedIn'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'selected_person_id' => 'required|exists:persons,id',
            'correct_person_id' => 'required|exists:persons,id',
        ]);

        $selectedPersonId = $request->input('selected_person_id');
        $correctPersonId = $request->input('correct_person_id');

        // Récupérer les informations des personnes pour l'affichage du résultat
        $selectedPerson = Person::find($selectedPersonId);
        $correctPerson = Person::find($correctPersonId);

        // Traiter les images
        $selectedPerson->face_photo_url = $this->getImagePath($selectedPerson->face_photo);
        $correctPerson->face_photo_url = $this->getImagePath($correctPerson->face_photo);
        $correctPerson->feet_photo_url = $this->getImagePath($correctPerson->feet_photo);

        // Gestion du score selon l'état de connexion
        $currentScore = $this->getScore();
        $totalGames = $this->getTotalGames() + 1;

        if ($selectedPersonId == $correctPersonId) {
            // Bonne réponse : incrémenter le score
            $newScore = $currentScore + 1;
            $this->saveScore($newScore, $totalGames);

            return redirect()->route('guess.index')
                ->with('success', true)
                ->with('victory_message', 'Bravo ! Vous avez trouvé la bonne réponse !')
                ->with('score', $newScore)
                ->with('total_games', $totalGames)
                ->with('show_result', true)
                ->with('selectedPerson', $selectedPerson)
                ->with('correctPerson', $correctPerson);
        } else {
            // Mauvaise réponse : garder le même score
            $this->saveScore($currentScore, $totalGames);

            return redirect()->route('guess.index')
                ->with('success', false)
                ->with('defeat_message', 'Dommage ! Ce n\'était pas la bonne réponse.')
                ->with('score', $currentScore)
                ->with('total_games', $totalGames)
                ->with('show_result', true)
                ->with('selectedPerson', $selectedPerson)
                ->with('correctPerson', $correctPerson);
        }
    }

    public function result()
    {
        // Cette méthode peut être supprimée ou utilisée pour autre chose
        // car maintenant tout se passe dans index
        return redirect()->route('guess.index');
    }
    public function resetScore()
    {
        // dd('Reset method called!');
        try {
            $user = auth()->user();
            $user->guess_game_score = 0;
            $user->guess_game_total = 0;
            $user->save();
            return redirect()->route('guess.index')->with('success', 'Score remis à zéro !');

        } catch (\Exception $e) {
            \Log::error('Erreur lors du reset du score: ' . $e->getMessage());
            return redirect()->route('guess.index')->with('error', 'Erreur lors du reset du score');
        }
    }

    /**
     * Récupère le score selon l'état de connexion
     */
    private function getScore()
    {
        if (auth()->check()) {
            return auth()->user()->guess_game_score ?? 0;
        }
        return session('score', 0);
    }

    /**
     * Récupère le total de parties selon l'état de connexion
     */
    private function getTotalGames()
    {
        if (auth()->check()) {
            return auth()->user()->guess_game_total ?? 0;
        }
        return session('total_games', 0);
    }

    /**
     * Sauvegarde le score selon l'état de connexion
     */
    private function saveScore($score, $totalGames)
    {
        if (auth()->check()) {
            // Utilisateur connecté : sauvegarder en base de données
            auth()->user()->update([
                'guess_game_score' => $score,
                'guess_game_total' => $totalGames
            ]);
        } else {
            // Utilisateur non connecté : sauvegarder en session
            session(['score' => $score, 'total_games' => $totalGames]);
        }
    }

    /**
     * Génère l'URL complète pour une image
     */
    private function getImagePath($imagePath)
    {
        if (empty($imagePath)) {
            return asset('images/default-person.png');
        }

        if (Str::startsWith($imagePath, ['http://', 'https://'])) {
            return $imagePath;
        }

        if (Str::startsWith($imagePath, 'storage/')) {
            return asset($imagePath);
        }

        return asset('storage/' . $imagePath);
    }
}