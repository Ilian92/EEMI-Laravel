<section class="space-y-6">
    <header>
        <h2 class="text-2xl font-bold text-red-600 mb-2">
            {{ __('Supprimer le Compte') }}
        </h2>
        <p class="text-gray-600">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all duration-200 hover:transform hover:scale-105"
    >
        {{ __('Supprimer le Compte') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 mb-4">
                {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
            </h2>

            <p class="text-sm text-gray-600 mb-6">
                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
            </p>

            <div class="mb-6">
                <label for="password" class="sr-only">{{ __('Mot de passe') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-3/4 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent transition-all duration-200"
                    style="focus:ring-color: #00aff0;"
                    placeholder="{{ __('Mot de passe') }}"
                />
                @error('password', 'userDeletion')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition-colors duration-200"
                >
                    {{ __('Annuler') }}
                </button>

                <button
                    type="submit"
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all duration-200 hover:transform hover:scale-105"
                >
                    {{ __('Supprimer le Compte') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>