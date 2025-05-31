<x-layout>
    <!-- Header Section -->
    <section class="bg-gradient-to-br from-blue-50 to-indigo-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="flex justify-center mb-8">
                    <img 
                        src="{{ Vite::asset('resources/img/only-feets-logo.png') }}" 
                        alt="OnlyFeets Logo" 
                        class="h-16 w-auto"
                    >
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ __('Vérification Email') }}
                </h1>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-20 bg-white">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm text-center">
                <div class="mb-6">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: #00aff0;">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a2 2 0 002.83 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600">
                        {{ __('Merci de vous être inscrit ! Avant de commencer, pourriez-vous vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer ? Si vous n\'avez pas reçu l\'email, nous vous en enverrons volontiers un autre.') }}
                    </p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-sm text-green-600 font-medium">
                            {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse email que vous avez fournie lors de l\'inscription.') }}
                        </p>
                    </div>
                @endif

                <div class="flex flex-col space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button 
                            type="submit"
                            class="w-full px-6 py-3 rounded-lg font-medium text-white transition-all duration-200 hover:transform hover:scale-105"
                            style="background-color: #00aff0;"
                            onmouseover="this.style.backgroundColor='#0099d9';"
                            onmouseout="this.style.backgroundColor='#00aff0';"
                        >
                            {{ __('Renvoyer l\'Email de Vérification') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button 
                            type="submit" 
                            class="w-full px-6 py-3 rounded-lg font-medium text-gray-700 border-2 border-gray-300 hover:border-gray-400 transition-all duration-200"
                        >
                            {{ __('Se Déconnecter') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>