<x-layout>
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold mb-8">Mes abonnements</h1>

      @if($subscriptions->isEmpty())
        <p class="text-gray-600">Vous n'êtes abonné à aucun créateur pour le moment.</p>
      @else
        <div class="space-y-6">
          @foreach($subscriptions as $sub)
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
              <div class="flex-1">
                <a href="{{ route('user-profile.show', $sub->creator->username) }}"
                   class="text-lg font-semibold text-blue-600 hover:underline">
                  {{ $sub->creator->name }}
                </a>
                <p class="text-sm text-gray-500">
                  Expire dans {{ $sub->expires_at->diffForHumans() }}
                  — Statut : <span class="font-medium">{{ $sub->is_active ? 'Actif' : 'Inactif' }}</span>
                </p>
              </div>
              <div class="ml-4">
                <span class="text-gray-700">{{ number_format($sub->amount, 2) }}€</span>
              </div>
            </div>
          @endforeach
        </div>

        <div class="mt-8">
          {{ $subscriptions->links() }}
        </div>
      @endif
    </div>
  </section>
</x-layout>