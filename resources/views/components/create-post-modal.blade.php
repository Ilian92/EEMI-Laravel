<x-modal name="create-post" :show="false">
    <div class="p-6">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
            <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3 bg-blue-500">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            Créer un nouveau post
        </h2>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="mt-4"
            x-data="{ imageUrl: '', fileName: '' }">
            @csrf

            {{-- Contenu du post --}}
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
                <textarea name="content" id="content" rows="4" required
                    class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none px-4 py-3 transition duration-200"
                    placeholder="Que voulez-vous partager ?"></textarea>
            </div>

            {{-- Image à télécharger --}}
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image (optionnel)</label>

                <input type="file" name="image" id="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0 file:text-sm file:font-semibold
                           file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100
                           border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" @change="
                        fileName = $event.target.files[0]?.name;
                        imageUrl = URL.createObjectURL($event.target.files[0]);
                    ">

                <small class="text-gray-500 mt-1 block">Formats acceptés : JPEG, PNG, JPG, GIF, WebP (max 2MB)</small>
            </div>

            {{-- Aperçu de l'image --}}
            <template x-if="imageUrl">
                <div class="mb-4">
                    <p class="text-sm font-semibold text-gray-700 mb-1">Aperçu :</p>
                    <img :src="imageUrl" alt="Image sélectionnée"
                        class="rounded-lg shadow-sm max-h-60 object-cover border border-gray-200" />
                </div>
            </template>

            {{-- Boutons --}}
            <div class="mt-6 flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close-modal', 'create-post')">
                    Annuler
                </x-secondary-button>

                <x-primary-button>
                    Publier
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>