@extends('layouts.admin')

@section('main-content')
  <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Hasil Pemilihan Ketua Osis') }}</h1>

  <div class="card shadow mb-4">
    <div class="card-body" style="height:400px;">
      <canvas id="hasilChart"></canvas>
    </div>
  </div>

  <div class="row mt-4">
    @foreach ($hasil as $item)
      <div class="col-md-4 mb-4">
        <div class="card shadow h-100">
          <div class="card-body text-center">
            <h5 class="card-title">{{ $item->kandidat->nama }}</h5>
            <p>Total Suara: <strong>{{ $item->total_suara }}</strong></p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    console.log('Chart status:', typeof Chart);
    document.addEventListener('DOMContentLoaded', function () {
      const ctx = document.getElementById('hasilChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: {!! $hasil->map(fn($item) => $item->kandidat->nama)->values()->toJson() !!},
          datasets: [{
            label: 'Total Suara',
            data: {!! $hasil->map(fn($item) => $item->total_suara)->values()->toJson() !!},
            backgroundColor: [
              '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'
            ],
            borderColor: '#ddd',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    });
  </script>
@endpush
