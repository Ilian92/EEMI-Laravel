@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl mb-4">Créer un nouveau post</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Message</label>
                <div class="mt-1">
                    <textarea id="content" name="content" rows="4"
                        class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder="Que voulez-vous partager ?">{{ old('content') }}</textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                    Publier
                </button>
            </div>
        </form>
    </div>
@endsection