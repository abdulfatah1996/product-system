@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h2 class="mb-4">📊 Admin Dashboard</h2>
    <div class="row mb-4">
        <div class="col-md-12">
            <canvas id="categoryChart" width="400" height="200" class="mt-4 mb-5"></canvas>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text fs-4">{{ $productsCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Categories</h5>
                    <p class="card-text fs-4">{{ $categoriesCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-warning shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Tags</h5>
                    <p class="card-text fs-4">{{ $tagsCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <h4>🆕 Latest Products</h4>
    <ul class="list-group">
        @foreach ($latestProducts as $product)
            <li class="list-group-item d-flex justify-content-between">
                <div>
                    <strong>{{ $product->name }}</strong>
                    <small class="text-muted d-block">Category: {{ $product->category->name }}</small>
                </div>
                <span>${{ $product->price }}</span>
            </li>
        @endforeach
    </ul>
@endsection



@section('scripts')
    <script>
        const ctx = document.getElementById('categoryChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($categoryNames) !!},
                datasets: [{
                    label: 'عدد المنتجات حسب التصنيف',
                    data: {!! json_encode($productCounts) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
    </script>
@endsection
