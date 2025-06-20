<x-layout>
  <section class="py-12 max-w-4xl mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Statistiques</h1>
    <canvas id="statsChart"></canvas>
  </section>

  {{-- Chart.js CDN --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('statsChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: @json($labels),
        datasets: [
          {
            label: "Nouveaux abonnés",
            data: @json($subsData),
            borderColor: "#00aff0",
            backgroundColor: "rgba(0,175,240,0.2)",
            yAxisID: 'y'
          },
          {
            label: "Chiffre d'affaires (€)",
            data: @json($revenueData),
            borderColor: "#f59e0b",
            backgroundColor: "rgba(245,158,11,0.2)",
            yAxisID: 'y1'
          }
        ]
      },
      options: {
        scales: {
          y: {
            type: 'linear',
            position: 'left',
            title: { display: true, text: 'Abonnés' }
          },
          y1: {
            type: 'linear',
            position: 'right',
            grid: { drawOnChartArea: false },
            title: { display: true, text: 'Revenu (€)' }
          }
        }
      }
    });
  </script>
</x-layout>