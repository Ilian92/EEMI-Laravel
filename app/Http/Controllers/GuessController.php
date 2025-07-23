<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Str;

class GuessController extends Controller
{
    public function index()
    {
        $correctPerson = Person::inRandomOrder()->first();

        if (!$correctPerson) {
            return redirect()->back()->with('error', 'Aucune personne trouvée dans la base de données');
        }

        $wrongPersons = Person::where('id', '!=', $correctPerson->id)
            ->inRandomOrder()
            ->limit(2)
            ->get();

        if ($wrongPersons->count() < 2) {
            return redirect()->back()->with('error', 'Il faut au moins 3 personnes dans la base de données');
        }

        $choices = collect([$correctPerson])->merge($wrongPersons)->shuffle();

        $correctPerson->feet_photo_url = $this->getImagePath($correctPerson->feet_photo);

        $choices->each(function ($person) {
            $person->face_photo_url = $this->getImagePath($person->face_photo);
        });

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

        $selectedPerson = Person::find($selectedPersonId);
        $correctPerson = Person::find($correctPersonId);

        $selectedPerson->face_photo_url = $this->getImagePath($selectedPerson->face_photo);
        $correctPerson->face_photo_url = $this->getImagePath($correctPerson->face_photo);
        $correctPerson->feet_photo_url = $this->getImagePath($correctPerson->feet_photo);

        $currentScore = $this->getScore();
        $totalGames = $this->getTotalGames() + 1;

        if ($selectedPersonId == $correctPersonId) {
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

    private function getScore()
    {
        if (auth()->check()) {
            return auth()->user()->guess_game_score ?? 0;
        }
        return session('score', 0);
    }

    private function getTotalGames()
    {
        if (auth()->check()) {
            return auth()->user()->guess_game_total ?? 0;
        }
        return session('total_games', 0);
    }

    private function saveScore($score, $totalGames)
    {
        if (auth()->check()) {
            auth()->user()->update([
                'guess_game_score' => $score,
                'guess_game_total' => $totalGames
            ]);
        } else {
            session(['score' => $score, 'total_games' => $totalGames]);
        }
    }

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