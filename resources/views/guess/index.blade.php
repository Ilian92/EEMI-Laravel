<x-layout>
    <!-- Hero Section avec titre du jeu -->
    <section class="bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    🦶 <span style="color: #00aff0;">Guess My Feet!</span> 🦶
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Testez vos connaissances ! Êtes-vous un vrai kiffeur (de pieds) ?
                </p>
            </div>
        </div>
    </section>

    <!-- Section principale du jeu -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('show_result'))
                <div class="result-container mb-8">
                    <!-- Bouton Reset Score (une seule fois) -->
                    <div class="mb-6 text-center">
                        <form action="{{ route('guess.reset-score') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    onclick="return confirm('⚠️ Voulez-vous vraiment remettre votre score à zéro ?')">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Reset Score
                            </button>
                        </form>
                    </div>

                    <!-- Résultat du jeu -->
                    @if(session('success'))
                        <div class="p-6 bg-green-50 border-l-4 border-green-400 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-green-700 font-medium">
                                        {{ session('victory_message') }}
                                    </p>
                                    <div class="mt-2 text-sm text-green-600">
                                        <strong>Score : {{ $score ?? 0 }} / {{ $totalGames ?? 0 }}</strong>
                                        <br>
                                        Pourcentage de réussite : {{ ($totalGames ?? 0) > 0 ? round((($score ?? 0) / $totalGames) * 100) : 0 }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="p-6 bg-red-50 border-l-4 border-red-400 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-red-700 font-medium">
                                        {{ session('defeat_message') }}
                                    </p>
                                    <div class="mt-2 text-sm text-red-600">
                                        <strong>Score : {{ $score ?? 0 }} / {{ $totalGames ?? 0 }}</strong>
                                        <br>
                                        La bonne réponse était : <strong>{{ session('correctPerson')->name ?? 'Inconnu' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <form method="POST" action="{{ route('guess.submit') }}" class="space-y-8">
                @csrf

                <!-- Photo des pieds à deviner -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-8 text-center">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">
                        À qui appartiennent ces pieds ?
                    </h2>
                    <div class="inline-block rounded-lg shadow-xl overflow-hidden">
                        <img src="{{ $correctPerson->feet_photo_url }}" alt="Pieds mystérieux"
                            class="max-h-80 w-auto object-cover">
                    </div>
                </div>

                <!-- Choix multiples -->
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($choices as $person)
                        <div class="bg-white rounded-xl border-2 border-gray-200 p-6 text-center">
                            <div class="mb-4">
                                <img src="{{ $person->face_photo_url }}" alt="{{ $person->name }}"
                                    class="w-24 h-24 mx-auto rounded-full object-cover border-4 border-gray-100 shadow-md">
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $person->name }}</h3>
                            <div class="flex items-center justify-center">
                                <input type="radio" name="selected_person_id"
                                    value="{{ $person->id }}" id="person{{ $person->id }}" required>
                                <label class="ml-2 text-gray-700 font-medium" for="person{{ $person->id }}">
                                    Choisir
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <input type="hidden" name="correct_person_id" value="{{ $correctPerson->id }}">

                <div class="text-center">
                <button type="submit" 
                            class="px-12 py-4 rounded-lg font-semibold text-white text-xl transition-all duration-200 hover:transform hover:scale-105 shadow-lg"
                            style="background-color: #00aff0;" 
                            onmouseover="this.style.backgroundColor='#0099d9';"
                            onmouseout="this.style.backgroundColor='#00aff0';">
                        🦶 Deviner ! 🦶
                    </button>
                </div>
            </form>
        </div>
    </section>


</x-layout>