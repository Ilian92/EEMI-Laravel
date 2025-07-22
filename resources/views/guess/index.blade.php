<x-layout>
    <!-- Hero Section avec titre du jeu -->
    <section class="bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    🦶 <span style="color: #00aff0;">Guess My Feet!</span> 🦶
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Testez vos connaissances ! Saurez-vous deviner à qui appartiennent ces pieds ?
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
                        <div class="choice-card bg-white rounded-xl border-2 border-gray-200 p-6 text-center cursor-pointer transition-all duration-200 hover:border-blue-300 hover:shadow-lg hover:transform hover:scale-105"
                             data-person-id="{{ $person->id }}">
                            <div class="mb-4">
                                <img src="{{ $person->face_photo_url }}" alt="{{ $person->name }}"
                                    class="w-24 h-24 mx-auto rounded-full object-cover border-4 border-gray-100 shadow-md">
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $person->name }}</h3>
                            <div class="flex items-center justify-center">
                                <input class="sr-only" type="radio" name="selected_person_id"
                                    value="{{ $person->id }}" id="person{{ $person->id }}" required>
                                <div class="radio-custom w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center">
                                    <div class="radio-dot w-2.5 h-2.5 rounded-full opacity-0 transition-opacity duration-200"
                                         style="background-color: #00aff0;"></div>
                                </div>
                                <label class="ml-2 text-gray-700 font-medium cursor-pointer" for="person{{ $person->id }}">
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

    <style>
        .choice-card.selected {
            border-color: #00aff0 !important;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            box-shadow: 0 10px 25px rgba(0, 175, 240, 0.15);
        }

        .choice-card.selected .radio-custom {
            border-color: #00aff0;
            background-color: #00aff0;
        }

        .choice-card.selected .radio-dot {
            opacity: 1;
            background-color: white !important;
        }

        .choice-card.selected h3 {
            color: #00aff0;
        }

        .choice-card:hover .radio-custom {
            border-color: #00aff0;
        }
    </style>

    <script>
        // Permettre de cliquer sur la carte entière pour sélectionner
        document.querySelectorAll('.choice-card').forEach(card => {
            card.addEventListener('click', function () {
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;

                // Retirer la classe selected de tous les cards
                document.querySelectorAll('.choice-card').forEach(c => c.classList.remove('selected'));
                // Ajouter la classe au card sélectionné
                this.classList.add('selected');
            });
        });
    </script>
</x-layout>