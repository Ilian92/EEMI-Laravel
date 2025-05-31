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
                    {{ __('Confirmation du Mot de Passe') }}
                </h1>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-20 bg-white">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
                <div class="mb-6 text-sm text-gray-600">
                    {{ __('Il s\'agit d\'une zone sécurisée de l\'application. Veuillez confirmer votre mot de passe avant de continuer.') }}
                </div>

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Mot de passe') }}
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent transition-all duration-200"
                            style="focus:ring-color: #00aff0;"
                            required 
                            autocomplete="current-password"
                        />
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button 
                            type="submit"
                            class="px-6 py-3 rounded-lg font-medium text-white transition-all duration-200 hover:transform hover:scale-105"
                            style="background-color: #00aff0;"
                            onmouseover="this.style.backgroundColor='#0099d9';"
                            onmouseout="this.style.backgroundColor='#00aff0';"
                        >
                            {{ __('Confirmer') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layout>