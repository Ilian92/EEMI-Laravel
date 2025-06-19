<header class="bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (Route::has('login'))
            <nav class="flex justify-between items-center h-16">
                <!-- Logo/Nom du site -->
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3">
                        <img src="{{ Vite::asset('resources/img/only-feets-logo.png') }}" alt="OnlyFeets Logo"
                            class="h-10 w-auto">
                        <span class="text-2xl font-bold" style="color: #00aff0;">
                            OnlyFeets
                        </span>
                    </a>
                </div>

                <!-- Menu de navigation -->
                <div class="flex items-center space-x-6">
                    @auth

                        @auth
                            <button x-data="" @click="$dispatch('open-modal', 'create-post')"
                                class="px-4 py-2 rounded-lg font-medium transition-all duration-200 hover:bg-opacity-10"
                                style="color: #00aff0; border: 2px solid #00aff0;">
                                Créer un post
                            </button>

                            <x-modal name="create-post" :show="false">
                                <div class="p-6">
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        Créer un nouveau post
                                    </h2>

                                    <form action="{{ route('posts.store') }}" method="POST" class="mt-6">
                                        @csrf
                                        <div>
                                            <textarea name="content" rows="4"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                placeholder="Que voulez-vous partager ?"></textarea>
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <x-secondary-button x-on:click="$dispatch('close-modal', 'create-post')">
                                                Annuler
                                            </x-secondary-button>

                                            <x-primary-button class="ml-3">
                                                Publier
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </div>
                            </x-modal>
                        @endauth
                        <a href="{{ url('/dashboard') }}"
                            class="px-4 py-2 rounded-lg font-medium transition-all duration-200 hover:bg-opacity-10"
                            style="color: #00aff0; border: 2px solid #00aff0;"
                            onmouseover="this.style.backgroundColor='#00aff0'; this.style.color='white';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#00aff0';">
                            Dashboard
                        </a>

                        <!-- Bouton de déconnexion -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 rounded-lg font-medium text-gray-600 hover:text-gray-800 transition-colors duration-200">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-lg font-medium text-gray-600 hover:text-gray-800 transition-colors duration-200">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 rounded-lg font-medium text-white transition-all duration-200 hover:bg-opacity-90"
                                style="background-color: #00aff0;" onmouseover="this.style.backgroundColor='#0099d9';"
                                onmouseout="this.style.backgroundColor='#00aff0';">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        @endif
    </div>
</header>