@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-transparent border-primary d-flex justify-content-between align-items-center">
            <h3 class="fw-bolder text-dark">✏️ Edit Product</h3>
            <div class="">
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">Back to Products</a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('products.update', $product) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Name</label>
                    <input name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Price</label>
                    <input name="price" type="number" step="0.01" class="form-control" value="{{ old('price', $product->price) }}" required>
                </div>

                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tags</label>
                    <select name="tags[]" multiple class="form-select">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}"
                                {{ $product->tags->contains($tag->id) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary">💾 Update</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
