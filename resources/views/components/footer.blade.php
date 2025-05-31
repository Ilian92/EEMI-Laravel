<footer class="bg-gray-50 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Logo et description -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <img 
                        src="{{ Vite::asset('resources/img/only-feets-logo.png') }}" 
                        alt="OnlyFeets Logo" 
                        class="h-8 w-auto"
                    >
                    <span class="text-xl font-bold" style="color: #00aff0;">
                        OnlyFeets
                    </span>
                </div>
                <p class="text-gray-600 text-sm">
                    La plateforme premium pour les passionnés de pieds. Découvrez du contenu exclusif et connectez-vous avec une communauté unique.
                </p>
            </div>

            <!-- Liens rapides -->
            <div class="space-y-4">
                <h3 class="text-gray-900 font-semibold">Liens rapides</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ url('/') }}" class="text-gray-600 hover:text-gray-900 text-sm transition-colors duration-200">
                            Accueil
                        </a>
                    </li>
                    @auth
                        <li>
                            <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-gray-900 text-sm transition-colors duration-200">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-600 hover:text-gray-900 text-sm transition-colors duration-200">
                                Mon Profil
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm transition-colors duration-200">
                                Connexion
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 text-sm transition-colors duration-200">
                                Inscription
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

            <!-- Informations légales -->
            <div class="space-y-4">
                <h3 class="text-gray-900 font-semibold">Légal</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="text-gray-600 hover:text-gray-900 text-sm transition-colors duration-200">
                            Conditions d'utilisation
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-gray-900 text-sm transition-colors duration-200">
                            Politique de confidentialité
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-gray-900 text-sm transition-colors duration-200">
                            Contact
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-gray-900 text-sm transition-colors duration-200">
                            Support
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Séparateur et copyright -->
        <div class="border-t border-gray-200 mt-8 pt-6">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-2 md:space-y-0">
                <p class="text-gray-500 text-sm">
                    © {{ date('Y') }} OnlyFeets. Tous droits réservés.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.749.099.12.112.225.085.347-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.751-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24c6.624 0 11.99-5.367 11.99-12C24.007 5.367 18.641.001 12.017.001z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>