<section>
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">
            {{ __('Modifier le Mot de Passe') }}
        </h2>
        <p class="text-gray-600">
            {{ __('Assurez-vous d\'utiliser un mot de passe long et aléatoire pour rester en sécurité.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Mot de passe actuel') }}
            </label>
            <input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent transition-all duration-200" 
                style="focus:ring-color: #00aff0;"
                autocomplete="current-password"
            />
            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Nouveau mot de passe') }}
            </label>
            <input 
                id="update_password_password" 
                name="password" 
                type="password" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent transition-all duration-200" 
                style="focus:ring-color: #00aff0;"
                autocomplete="new-password"
            />
            @error('password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Confirmer le mot de passe') }}
            </label>
            <input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent transition-all duration-200" 
                style="focus:ring-color: #00aff0;"
                autocomplete="new-password"
            />
            @error('password_confirmation', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
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

            @if (session('status') === 'password-updated')
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