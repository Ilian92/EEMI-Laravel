<x-layout>
    <!-- Banner Section -->
    <section class="relative h-64 md:h-80 bg-gradient-to-br from-blue-50 to-indigo-100 overflow-hidden">
        <img 
            src="{{ $user->banner_image_url }}" 
            alt="{{ __('Bannière de :name', ['name' => $user->name]) }}"
            class="w-full h-full object-cover"
        >
        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
    </section>

    <!-- Profile Info Section -->
    <section class="relative -mt-20 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <!-- Messages de notification -->
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-sm text-green-600 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-600 font-medium">{{ session('error') }}</p>
                    </div>
                @endif

                <div class="flex flex-col md:flex-row items-start md:items-end space-y-4 md:space-y-0 md:space-x-6">
                    <!-- Profile Picture -->
                    <div class="relative">
                        <img 
                            src="{{ $user->profile_picture_url }}" 
                            alt="{{ __('Photo de :name', ['name' => $user->name]) }}"
                            class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover"
                        >
                        @if($user->is_creator)
                            <div class="absolute -bottom-2 -right-2 w-8 h-8 rounded-full flex items-center justify-center" style="background-color: #00aff0;">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- User Info -->
                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                                <p class="text-lg text-gray-600">{{ $user->username }}</p>
                                @if($user->bio)
                                    <p class="mt-2 text-gray-700">{{ $user->bio }}</p>
                                @endif
                            </div>

                            <!-- Subscribe Button -->
                            @auth
                                @if(Auth::id() !== $user->id && $user->is_creator)
                                    <div class="mt-4 md:mt-0">
                                        @if($isSubscribed)
                                            <form method="POST" action="{{ route('user-profile.unsubscribe', $user) }}" class="inline">
                                                @csrf
                                                <button 
                                                    type="submit"
                                                    class="px-6 py-3 rounded-lg font-medium text-gray-700 border-2 border-gray-300 hover:border-gray-400 transition-all duration-200"
                                                >
                                                    {{ __('Se désabonner') }}
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('user-profile.subscribe', $user) }}" class="inline">
                                                @csrf
                                                <button 
                                                    type="submit"
                                                    class="px-6 py-3 rounded-lg font-medium text-white transition-all duration-200 hover:transform hover:scale-105"
                                                    style="background-color: #00aff0;"
                                                    onmouseover="this.style.backgroundColor='#0099d9';"
                                                    onmouseout="this.style.backgroundColor='#00aff0';"
                                                >
                                                    {{ __('S\'abonner') }} - {{ number_format($user->subscription_price, 2) }}€/mois
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            @else
                                @if($user->is_creator)
                                    <div class="mt-4 md:mt-0">
                                        <a 
                                            href="{{ route('login') }}"
                                            class="px-6 py-3 rounded-lg font-medium text-white transition-all duration-200 hover:transform hover:scale-105"
                                            style="background-color: #00aff0;"
                                            onmouseover="this.style.backgroundColor='#0099d9';"
                                            onmouseout="this.style.backgroundColor='#00aff0';"
                                        >
                                            {{ __('Se connecter pour s\'abonner') }}
                                        </a>
                                    </div>
                                @endif
                            @endauth
                        </div>

                        <!-- Stats -->
                        <div class="flex space-x-6 mt-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold" style="color: #00aff0;">{{ $subscribersCount }}</div>
                                <div class="text-sm text-gray-600">{{ __('Abonnés') }}</div>
                            </div>
                            @if($user->creator_since)
                                <div class="text-center">
                                    <div class="text-2xl font-bold" style="color: #00aff0;">{{ max(1, ceil($user->creator_since->diffInMonths())) }}</div>
                                    <div class="text-sm text-gray-600">{{ __('Mois') }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($user->is_creator)
                <div class="text-center py-12">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: #00aff0;">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Contenu en préparation') }}</h3>
                    <p class="text-gray-600">{{ __('Ce créateur travaille sur du contenu exclusif. Abonnez-vous pour être notifié !') }}</p>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Profil utilisateur') }}</h3>
                    <p class="text-gray-600">{{ __('Cet utilisateur n\'est pas encore créateur de contenu.') }}</p>
                </div>
            @endif
        </div>
    </section>
</x-layout>