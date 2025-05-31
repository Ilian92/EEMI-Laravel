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
                    {{ __('Rejoindre') }} <span style="color: #00aff0;">OnlyFeets</span>
                </h1>
                <p class="text-lg text-gray-600">
                    {{ __('Créez votre compte et découvrez une communauté unique') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-20 bg-white">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Nom') }}
                        </label>
                        <input 
                            id="name" 
                            name="name" 
                            type="text" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent transition-all duration-200"
                            style="focus:ring-color: #00aff0;"
                            value="{{ old('name') }}" 
                            required 
                            autofocus 
                            autocomplete="name"
                        />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Nom d\'utilisateur') }}
                        </label>
                        <input 
                            id="username" 
                            name="username" 
                            type="text" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent transition-all duration-200"
                            style="focus:ring-color: #00aff0;"
                            value="{{ old('username') }}" 
                            required 
                            autocomplete="username"
                        />
                        @error('username')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            {{ __('Votre nom d\'utilisateur sera visible publiquement sur OnlyFeets') }}
                        </p>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Email') }}
                        </label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent transition-all duration-200"
                            style="focus:ring-color: #00aff0;"
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="email"
                        />
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
                            autocomplete="new-password"
                        />
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Confirmer le mot de passe') }}
                        </label>
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent transition-all duration-200"
                            style="focus:ring-color: #00aff0;"
                            required 
                            autocomplete="new-password"
                        />
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <a 
                            href="{{ route('login') }}" 
                            class="text-sm hover:underline"
                            style="color: #00aff0;"
                        >
                            {{ __('Déjà inscrit ?') }}
                        </a>

                        <button 
                            type="submit"
                            class="px-6 py-3 rounded-lg font-medium text-white transition-all duration-200 hover:transform hover:scale-105"
                            style="background-color: #00aff0;"
                            onmouseover="this.style.backgroundColor='#0099d9';"
                            onmouseout="this.style.backgroundColor='#00aff0';"
                        >
                            {{ __('S\'inscrire') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layout>