<x-layout>
  <!-- Header Section -->
  <section class="bg-gradient-to-br from-blue-50 to-indigo-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
          Mes <span style="color: #00aff0;">Statistiques</span>
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
          Analysez vos performances et suivez votre croissance
        </p>
      </div>
    </div>
  </section>

  <!-- Stats Content -->
  <section class="py-12 max-w-7xl mx-auto px-4">
    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <div class="flex items-center">
          <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4" style="background-color: #00aff0;">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
          </div>
          <div>
            <p class="text-2xl font-bold" style="color: #00aff0;">{{ $totalSubscribers }}</p>
            <p class="text-sm text-gray-600">Abonnés actuels</p>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <div class="flex items-center">
          <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4" style="background-color: #f59e0b;">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
            </svg>
          </div>
          <div>
            <p class="text-2xl font-bold text-amber-600">{{ number_format($totalRevenue, 2) }}€</p>
            <p class="text-sm text-gray-600">Revenus totaux</p>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <div class="flex items-center">
          <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4" style="background-color: #10b981;">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
          </div>
          <div>
            <p class="text-2xl font-bold text-green-600">{{ number_format($monthlyRevenue, 2) }}€</p>
            <p class="text-sm text-gray-600">Ce mois-ci</p>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <div class="flex items-center">
          <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4" style="background-color: #8b5cf6;">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
          </div>
          <div>
            <p class="text-2xl font-bold text-purple-600">{{ number_format($avgRevenue, 2) }}€</p>
            <p class="text-sm text-gray-600">Revenu moyen/abonné</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
      <!-- Revenue & Subscribers Chart -->
      <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <h3 class="text-lg font-bold mb-4">Évolution des abonnés et revenus</h3>
        <canvas id="growthChart" height="300"></canvas>
      </div>

      <!-- Subscription Trend -->
      <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <h3 class="text-lg font-bold mb-4">Tendances d'abonnements</h3>
        <canvas id="subscriptionChart" height="300"></canvas>
      </div>
    </div>

    <!-- Performance Metrics -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Retention Rate -->
      <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <h3 class="text-lg font-bold mb-4">Taux de rétention</h3>
        <div class="text-center">
          <div class="text-4xl font-bold mb-2" style="color: #00aff0;">{{ number_format($retentionRate, 1) }}%</div>
          <p class="text-gray-600">Abonnés conservés</p>
          <div class="mt-4 bg-gray-200 rounded-full h-2">
            <div class="h-2 rounded-full" style="background-color: #00aff0; width: {{ $retentionRate }}%;"></div>
          </div>
        </div>
      </div>

      <!-- Growth Rate -->
      <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <h3 class="text-lg font-bold mb-4">Croissance mensuelle</h3>
        <div class="text-center">
          <div class="text-4xl font-bold mb-2 {{ $growthRate >= 0 ? 'text-green-600' : 'text-red-600' }}">
            {{ $growthRate >= 0 ? '+' : '' }}{{ number_format($growthRate, 1) }}%
          </div>
          <p class="text-gray-600">vs mois dernier</p>
          <div class="mt-4">
            @if($growthRate >= 0)
              <svg class="w-8 h-8 mx-auto text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
              </svg>
            @else
              <svg class="w-8 h-8 mx-auto text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
              </svg>
            @endif
          </div>
        </div>
      </div>

      <!-- Top Periods -->
      <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <h3 class="text-lg font-bold mb-4">Meilleures performances</h3>
        <div class="space-y-3">
          @foreach($topMonths as $month)
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-600">{{ $month['month'] }}</span>
              <span class="font-medium">{{ $month['count'] }} nouveaux</span>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  {{-- Chart.js CDN --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Growth Chart
    const growthCtx = document.getElementById('growthChart').getContext('2d');
    new Chart(growthCtx, {
      type: 'line',
      data: {
        labels: @json($labels),
        datasets: [
          {
            label: "Nouveaux abonnés",
            data: @json($subsData),
            borderColor: "#00aff0",
            backgroundColor: "rgba(0,175,240,0.1)",
            yAxisID: 'y',
            tension: 0.4
          },
          {
            label: "Revenus (€)",
            data: @json($revenueData),
            borderColor: "#f59e0b",
            backgroundColor: "rgba(245,158,11,0.1)",
            yAxisID: 'y1',
            tension: 0.4
          }
        ]
      },
      options: {
        responsive: true,
        interaction: { intersect: false },
        scales: {
          y: {
            type: 'linear',
            position: 'left',
            title: { display: true, text: 'Abonnés' },
            grid: { color: 'rgba(0,0,0,0.1)' }
          },
          y1: {
            type: 'linear',
            position: 'right',
            grid: { drawOnChartArea: false },
            title: { display: true, text: 'Revenus (€)' }
          }
        },
        plugins: {
          legend: { position: 'top' }
        }
      }
    });

    // Subscription Trend Chart
    const subscriptionCtx = document.getElementById('subscriptionChart').getContext('2d');
    new Chart(subscriptionCtx, {
      type: 'bar',
      data: {
        labels: @json($labels),
        datasets: [
          {
            label: "Nouveaux abonnements",
            data: @json($subsData),
            backgroundColor: "rgba(0,175,240,0.8)",
            borderColor: "#00aff0",
            borderWidth: 1
          },
          {
            label: "Désabonnements",
            data: @json($unsubsData),
            backgroundColor: "rgba(239,68,68,0.8)",
            borderColor: "#ef4444",
            borderWidth: 1
          }
        ]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            title: { display: true, text: 'Nombre' }
          }
        },
        plugins: {
          legend: { position: 'top' }
        }
      }
    });
  </script>
</x-layout>