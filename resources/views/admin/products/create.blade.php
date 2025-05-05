@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-transparent border-primary d-flex justify-content-between align-items-center">
            <h3 class="fw-bolder text-dark">➕New Product</h3>
            <div class="">
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">Back to Products</a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('products.store') }}">
                @csrf

                <div class="mb-3">
                    <label>Name</label>
                    <input name="name" class="form-control form-control-sm" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control form-control-sm"></textarea>
                </div>

                <div class="mb-3">
                    <label>Price</label>
                    <input name="price" type="number" step="0.01" class="form-control form-control-sm" required>
                </div>

                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-select form-select-sm" required>
                        <option value="">-- Select --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Tags</label>
                    <select name="tags[]" multiple class="form-select form-select-sm">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl (Windows) / ⌘ (Mac) to select multiple</small>
                </div>
                <button class="btn btn-sm btn-success">💾 Save</button>
            </form>
        </div>
    </div>
@endsection
