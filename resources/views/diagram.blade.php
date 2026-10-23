<x-mainpage>
  <h1 class="mb-1">Diagram</h1>
  <p class="text-muted">A Művészfilm Kht. adatai diagramokon ({{ $ev }}. év).</p>

  <div class="row g-4">
    <div class="col-12">
      <div class="card shadow-sm"><div class="card-body">
        <h5 class="card-title">Havi bevétel (Ft)</h5>
        <canvas id="haviChart" height="110"></canvas>
      </div></div>
    </div>

    <div class="col-lg-6">
      <div class="card shadow-sm"><div class="card-body">
        <h5 class="card-title">Nézők száma városonként (top 10)</h5>
        <canvas id="varosChart"></canvas>
      </div></div>
    </div>

    <div class="col-lg-6">
      <div class="card shadow-sm"><div class="card-body">
        <h5 class="card-title">Legnagyobb bevételű filmek (top 10, Ft)</h5>
        <canvas id="filmChart"></canvas>
      </div></div>
    </div>
  </div>

  @push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
  <script>
    const ft = new Intl.NumberFormat('hu-HU');

    new Chart(document.getElementById('haviChart'), {
      type: 'line',
      data: {
        labels: @json($haviCimkek),
        datasets: [{
          label: 'Bevétel (Ft)',
          data: @json($haviAdatok),
          borderColor: '#0d6efd',
          backgroundColor: 'rgba(13,110,253,0.15)',
          fill: true,
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        plugins: { tooltip: { callbacks: { label: c => ft.format(c.parsed.y) + ' Ft' } } },
        scales: { y: { beginAtZero: true, ticks: { callback: v => ft.format(v) } } }
      }
    });

    new Chart(document.getElementById('varosChart'), {
      type: 'bar',
      data: {
        labels: @json($varosCimkek),
        datasets: [{
          label: 'Nézők száma',
          data: @json($varosAdatok),
          backgroundColor: '#20c997'
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { callback: v => ft.format(v) } } }
      }
    });

    new Chart(document.getElementById('filmChart'), {
      type: 'bar',
      data: {
        labels: @json($filmCimkek),
        datasets: [{
          label: 'Bevétel (Ft)',
          data: @json($filmAdatok),
          backgroundColor: '#fd7e14'
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { x: { beginAtZero: true, ticks: { callback: v => ft.format(v) } } }
      }
    });
  </script>
  @endpush
</x-mainpage>