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
                    {{ __('Connexion à') }} <span style="color: #00aff0;">OnlyFeets</span>
                </h1>
                <p class="text-lg text-gray-600">
                    {{ __('Accédez à votre compte pour découvrir du contenu exclusif') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-20 bg-white">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-sm text-green-600 font-medium">{{ session('status') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="login" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Email ou Nom d\'utilisateur') }}
                        </label>
                        <input 
                            id="login" 
                            name="login" 
                            type="text" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent transition-all duration-200"
                            style="focus:ring-color: #00aff0;"
                            value="{{ old('login') }}" 
                            required 
                            autofocus 
                            autocomplete="username"
                            placeholder="{{ __('votre@email.com ou votre_username') }}"
                        />
                        @error('login')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

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

                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            class="rounded border-gray-300 shadow-sm" 
                            style="color: #00aff0;"
                            name="remember"
                        >
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                            {{ __('Se souvenir de moi') }}
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        @if (Route::has('password.request'))
                            <a 
                                href="{{ route('password.request') }}" 
                                class="text-sm hover:underline"
                                style="color: #00aff0;"
                            >
                                {{ __('Mot de passe oublié ?') }}
                            </a>
                        @endif

                        <button 
                            type="submit"
                            class="px-6 py-3 rounded-lg font-medium text-white transition-all duration-200 hover:transform hover:scale-105"
                            style="background-color: #00aff0;"
                            onmouseover="this.style.backgroundColor='#0099d9';"
                            onmouseout="this.style.backgroundColor='#00aff0';"
                        >
                            {{ __('Se connecter') }}
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        {{ __('Pas encore membre ?') }}
                        <a 
                            href="{{ route('register') }}" 
                            class="font-medium hover:underline"
                            style="color: #00aff0;"
                        >
                            {{ __('Créer un compte') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-layout>