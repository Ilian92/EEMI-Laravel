<x-layout>
    <section class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-8">Feed des créateurs</h1>

        @foreach ($topCreators as $creator)
            <div class="bg-white rounded-lg shadow-lg p-6 mb-16">
                <div class="flex items-center mb-4">
                    <img src="{{ $creator->avatar_url ?? '/default-avatar.jpg' }}" alt="{{ $creator->name }}"
                        class="w-20 h-20 rounded-full object-cover mr-4">
                    <div class="flex items-center justify-between w-full">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">{{ $creator->name }}</h3>
                            <p class="text-gray-600">{{ '@' . $creator->username }} — <span
                                    class="font-medium">{{ $creator->subscribers()->where('is_active', true)->count() }}</span>
                                abonnés</p>
                        </div>

                        @auth
                            @if(auth()->id() !== $creator->id)
                                @php
                                    $isSubscribed = auth()->user()->isSubscribedTo($creator);
                                @endphp

                                @if($isSubscribed)
                                    <form method="POST" action="{{ route('user-profile.unsubscribe', $creator->id) }}">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                            Se désabonner
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('user-profile.subscribe', $creator->id) }}">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                            S'abonner
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                Connexion pour s'abonner
                            </a>
                        @endauth

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