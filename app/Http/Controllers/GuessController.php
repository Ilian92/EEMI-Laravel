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

        return view('guess.index', compact('correctPerson', 'choices'));
    }

    public function result()
    {
        if (!session()->has('success') && !session()->has('error')) {
            return redirect()->route('guess.index');
        }

        // Sélectionner une personne au hasard pour les pieds à deviner
        $correctPerson = Person::inRandomOrder()->first();
        // Traitement des chemins d'images pour la personne correcte
        $correctPerson->feet_photo_url = $this->getImagePath($correctPerson->feet_photo);

        return view('guess.result')->with('isCorrect', session('isCorrect'));
    }



    /**
     * Génère l'URL complète pour une image
     * 
     * @param string|null $imagePath
     * @return string
     */
    private function getImagePath($imagePath)
    {
        if (empty($imagePath)) {
            return asset('images/default-person.png'); // Image par défaut
        }

        // Si le chemin commence par 'http', c'est déjà une URL complète
        if (Str::startsWith($imagePath, ['http://', 'https://'])) {
            return $imagePath;
        }

        // Si le chemin commence par 'storage/', utiliser asset()
        if (Str::startsWith($imagePath, 'storage/')) {
            return asset($imagePath);
        }

        // Sinon, construire le chemin depuis le dossier storage
        return asset('storage/' . $imagePath);
    }

    /**
     * Alternative: Méthode pour obtenir l'URL d'une image avec gestion d'erreur
     * 
     * @param string|null $imagePath
     * @param string $defaultImage
     * @return string
     */
    private function getImageUrl($imagePath, $defaultImage = 'images/default-person.png')
    {
        if (empty($imagePath)) {
            return asset($defaultImage);
        }

        // URL complète
        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }

        // Chemin local
        $fullPath = storage_path('app/public/' . ltrim($imagePath, '/'));

        if (file_exists($fullPath)) {
            return asset('storage/' . ltrim($imagePath, '/'));
        }

        // Si le fichier n'existe pas, retourner l'image par défaut
        return asset($defaultImage);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'selected_person_id' => 'required|exists:persons,id',
            'correct_person_id' => 'required|exists:persons,id',
        ]);

        $selectedPersonId = $request->input('selected_person_id');
        $correctPersonId = $request->input('correct_person_id');
        $correctPerson = Person::find($correctPersonId);

        if ($selectedPersonId == $correctPersonId) {
            return redirect()->route('guess.result')->with([
                'success' => 'Bravo ! Vous avez trouvé la bonne réponse !',
                'isCorrect' => true,
                'correctPerson' => $correctPerson,
            ]);
        } else {
            return redirect()->route('guess.result')->with([
                'error' => 'Dommage ! Ce n\'était pas la bonne réponse.',
                'isCorrect' => false,
                'correctPerson' => $correctPerson,
            ]);
        }
    }
}