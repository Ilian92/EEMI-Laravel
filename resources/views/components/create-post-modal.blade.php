<x-modal name="create-post" :show="false">
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Créer un nouveau post
        </h2>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <textarea name="content" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Que voulez-vous partager ?"></textarea>
                </div>

                <div x-data="{ imageUrl: '' }" class="space-y-2">
                    <label for="image" class="block text-sm font-medium text-gray-700">
                        Image
                    </label>
                    <input type="file" id="image" name="image" accept="image/*"
                        @change="imageUrl = URL.createObjectURL($event.target.files[0])" class="mt-1 block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-indigo-50 file:text-indigo-700
                            hover:file:bg-indigo-100">

                    <!-- Preview Image -->
                    <template x-if="imageUrl">
                        <img :src="imageUrl" class="mt-2 rounded-lg max-h-48 object-cover">
                    </template>
                </div>
            </div>

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