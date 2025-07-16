<x-layout>
    <!-- Header Section -->
    <section class="bg-gradient-to-br from-blue-50 to-indigo-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Liste des <span style="color: #00aff0;">Posts</span>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Partagez vos idées et explorez les contributions de la communauté.
                </p>
            </div>
        </div>
    </section>

    <!-- Posts Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Posts List -->
            <div class="mt-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Liste des posts</h2>
                @foreach ($posts as $post)
                    <div class="bg-white rounded-lg shadow-md p-6 mt-4">
                        <p class="text-sm font-semibold text-gray-800">{{ $post->user->name }}</p>
                        <p class="text-sm text-gray-700">{{ $post->content }}</p>
                        @if ($post->image_path)
                            <img src="{{ asset("storage/{$post->image_path}") }}" alt="Image du post" class="mt-4 max-w-full">
                        @else
                            <img src="{{ asset('images/default.png') }}" alt="Image par défaut" class="mt-4 max-w-full">
                        @endif
                        <p class="text-xs text-gray-500 mt-4">{{ $post->created_at->format('d/m/Y à H:i') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>
</x-layout>