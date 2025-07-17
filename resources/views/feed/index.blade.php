<x-layout>
    <section class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-8">Feed des créateurs</h1>

        @foreach ($topCreators as $creator)
            <div class="bg-white rounded-lg shadow-lg p-6 mb-16">
                <div class="flex items-center mb-4">
                    <img src="{{ $creator->avatar_url ?? '/default-avatar.jpg' }}" alt="{{ $creator->name }}"
                        class="w-20 h-20 rounded-full object-cover mr-4">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">{{ $creator->name }}</h3>
                        <p class="text-gray-600">{{ '@' . $creator->username }} — <span
                                class="font-medium">{{ $creator->posts->count() }}</span> posts récents</p>
                    </div>
                </div>

                <div>
                    @foreach ($creator->posts as $post)
                        <div class="mb-4">
                            <p class="text-gray-700 text-sm mb-1">
                                {{ Str::limit(strip_tags($post->content), 100) }}
                            </p>
                            @if ($post->image_url)
                                <img src="{{ $post->image_url }}" alt="Image du post"
                                    class="size-full object-cover rounded-md mb-3 py-8" style="filter: blur(20px);">
                            @endif
                            <small class="text-gray-400 text-xs">{{ $post->created_at->format('d/m/Y') }}</small>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
</x-layout>