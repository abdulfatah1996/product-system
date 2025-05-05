@extends('layouts.app')
@section('title', 'Admin Products')

@section('content')
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-transparent border-primary d-flex justify-content-between align-items-center">
            <h3 class="fw-bolder text-dark">🛍️ Products</h3>
            <div class="">
                <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">Add New Product</a>
                <a href="{{ route('export.excel') }}" class="btn btn-sm btn-success me-2">Excel</a>
                <a href="{{ route('export.pdf') }}" class="btn btn-sm btn-danger me-2">PDF</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                @foreach ($product->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                                @endforeach
                            </td>
                            <td>${{ $product->price }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">DELETE</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $products->links() }}
        </div>
    </div>
@endsection
