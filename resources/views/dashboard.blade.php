<x-layout>
    <!-- Header Section -->
    <section class="bg-gradient-to-br from-blue-50 to-indigo-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Bienvenue sur votre <span style="color: #00aff0;">Dashboard</span>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Gérez votre profil, explorez le contenu et découvrez la communauté OnlyFeets
                </p>
            </div>
        </div>
    </section>

    <!-- Dashboard Content -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-6 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4" style="background-color: #00aff0;">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <a href="/profile">
                            <h3 class="text-lg font-semibold text-gray-900">Mon Profil</h3>
                            <p class="text-gray-600">Gérer mes informations</p>
                        </a>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4" style="background-color: #00aff0;">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Favoris</h3>
                            <p class="text-gray-600">Contenu sauvegardé</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4" style="background-color: #00aff0;">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Abonnements</h3>
                            <p class="text-gray-600">Mes créateurs</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Dashboard Content -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Welcome Card -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-lg border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">
                        Bienvenue, {{ Auth::user()->name }} !
                    </h2>
                    <p class="text-gray-600 mb-6">
                        Vous êtes maintenant connecté à OnlyFeets. Explorez notre contenu exclusif et découvrez les meilleurs créateurs.
                    </p>
                    <div class="flex space-x-4">
                        <a 
                            href="#" 
                            class="px-6 py-3 rounded-lg font-medium text-white transition-all duration-200 hover:transform hover:scale-105"
                            style="background-color: #00aff0;"
                            onmouseover="this.style.backgroundColor='#0099d9';"
                            onmouseout="this.style.backgroundColor='#00aff0';"
                        >
                            Explorer
                        </a>
                        <a 
                            href="#" 
                            class="px-6 py-3 rounded-lg font-medium text-gray-700 border-2 border-gray-300 hover:border-gray-400 transition-all duration-200"
                        >
                            Mon Profil
                        </a>
                    </div>
                </div>

                <!-- Activity Card -->
                <div class="bg-white p-8 rounded-lg border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Activité Récente</h2>
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center mr-4" style="background-color: #00aff0;">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Compte créé avec succès</p>
                                <p class="text-sm text-gray-600">Bienvenue dans la communauté OnlyFeets !</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center mr-4" style="background-color: #00aff0;">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Explorez le contenu</p>
                                <p class="text-sm text-gray-600">Découvrez nos créateurs populaires</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="py-16" style="background-color: #f8fbff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Actions Rapides</h2>
                <p class="text-gray-600">Tout ce dont vous avez besoin à portée de main</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <a href="#" class="text-center p-6 bg-white rounded-lg border border-gray-200 hover:shadow-lg transition-all duration-200 hover:transform hover:scale-105">
                    <div class="w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: #00aff0;">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Explorer</h3>
                </a>

                <a href="#" class="text-center p-6 bg-white rounded-lg border border-gray-200 hover:shadow-lg transition-all duration-200 hover:transform hover:scale-105">
                    <div class="w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: #00aff0;">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Créateurs</h3>
                </a>

                <a href="#" class="text-center p-6 bg-white rounded-lg border border-gray-200 hover:shadow-lg transition-all duration-200 hover:transform hover:scale-105">
                    <div class="w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: #00aff0;">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Paramètres</h3>
                </a>

                <a href="#" class="text-center p-6 bg-white rounded-lg border border-gray-200 hover:shadow-lg transition-all duration-200 hover:transform hover:scale-105">
                    <div class="w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: #00aff0;">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Support</h3>
                </a>
            </div>
        </div>
    </section>
</x-layout>