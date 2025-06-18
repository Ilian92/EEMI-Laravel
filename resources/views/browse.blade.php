<x-layout>
  <section class="py-12 max-w-7xl mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Parcourir les créateurs</h1>

    {{-- Barre de recherche --}}
    <div x-data="browse()" x-init="load()">
      <input
        x-model="search"
        @input.debounce.300="load()"
        type="text"
        placeholder="Rechercher..."
        class="w-full mb-6 p-3 border rounded"
      />

      {{-- Liste des créateurs --}}
      <div class="grid md:grid-cols-3 gap-6">
        <template x-for="c in creators.data" :key="c.id">
          <div class="bg-white p-4 rounded shadow">
            <h2 class="font-semibold text-lg" x-text="c.name"></h2>
            <p class="text-sm text-gray-500">
              Abonnés : <span x-text="c.subscribers_count"></span>
            </p>
          </div>
        </template>
      </div>

      {{-- Pagination --}}
      <div class="flex justify-between items-center mt-6">
        <button
          @click="load(creators.prev_page_url)"
          :disabled="!creators.prev_page_url"
          class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50"
        >Précédent</button>

        <button
          @click="load(creators.next_page_url)"
          :disabled="!creators.next_page_url"
          class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50"
        >Suivant</button>
      </div>
    </div>
  </section>

  <script>
    function browse() {
      return {
        search: '',
        creators: { data: [], prev_page_url: null, next_page_url: null },

        async load(url = '{{ route('browse') }}') {
          const params = new URL(url).searchParams;
          params.set('search', this.search);

          const res = await fetch(url.includes('?')
            ? url + '&search=' + encodeURIComponent(this.search)
            : url + '?search=' + encodeURIComponent(this.search),
            { headers: { 'X-Requested-With': 'XMLHttpRequest' } }
          );
          this.creators = await res.json();
        }
      }
    }
  </script>
</x-layout>