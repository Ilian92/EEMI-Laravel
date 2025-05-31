<section>
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">
            {{ __('Informations du Profil') }}
        </h2>
        <p class="text-gray-600">
            {{ __('Modifiez les informations de votre compte et votre adresse email.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

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
                value="{{ old('name', $user->name) }}" 
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
                value="{{ old('username', $user->username ?? '') }}" 
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
                value="{{ old('email', $user->email) }}" 
                required 
                autocomplete="email"
            />
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-sm text-yellow-800">
                        {{ __('Votre adresse email n\'est pas vérifiée.') }}
                        <button 
                            form="send-verification" 
                            class="underline text-sm hover:no-underline font-medium"
                            style="color: #00aff0;"
                        >
                            {{ __('Cliquez ici pour renvoyer l\'email de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse email.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button 
                type="submit"
                class="px-6 py-3 rounded-lg font-medium text-white transition-all duration-200 hover:transform hover:scale-105"
                style="background-color: #00aff0;"
                onmouseover="this.style.backgroundColor='#0099d9';"
                onmouseout="this.style.backgroundColor='#00aff0';"
            >
                {{ __('Sauvegarder') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium"
                >
                    {{ __('Sauvegardé.') }}
                </p>
            @endif
        </div>
    </form>
</section>