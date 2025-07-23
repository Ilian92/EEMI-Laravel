<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Résultat</h3>
                    </div>
                    <div class="card-body text-center">
                        @if ($isCorrect)
                            <p class="text-green-600 font-bold">🎉 Bonne réponse !</p>
                        @else
                            <p class="text-red-600 font-bold">❌ Mauvaise réponse !</p>
                        @endif


                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h4>Les pieds mystérieux</h4>
                                <img src="{{ $correctPerson->feet_photo_url }}"
                                    alt="Pieds de {{ $correctPerson->name }}" class="img-fluid rounded shadow"
                                    style="max-height: 200px;">
                            </div>
                            <div class="col-md-6">
                                <h4>{{ $correctPerson->name }}</h4>
                                <img src="{{ $correctPerson->face_photo_url }}" alt="{{ $correctPerson->name }}"
                                    class="img-fluid rounded-circle shadow"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('guess.index') }}" class="btn btn-primary btn-lg">
                                🔄 Jouer encore
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>