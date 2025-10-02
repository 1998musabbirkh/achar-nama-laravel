@extends('layouts.dashboard')

@section('title', 'Edit Product: ' . $product->title)

@section('content')
<div class="p-6 bg-surface rounded-sm shadow-md border border-main-border">
    <h1 class="text-3xl font-semibold text-text-primary mb-6">Edit Product: {{ $product->title }}</h1>

    <a href="{{ route('products.index') }}" class="text-brand-red hover:text-red-700 flex items-center mb-4">
        <x-heroicon-o-arrow-left class="w-4 h-4 mr-1" /> Back to Products
    </a>

    <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div>
            <label for="title" class="block text-sm font-medium text-text-secondary">Product Title</label>
            <input type="text" name="title" id="title" required
                class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red @error('title') border-red-500 @enderror"
                value="{{ old('title', $product->title) }}">
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-text-secondary">Description</label>
            <textarea name="description" id="description" rows="4"
                class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="short_description" class="block text-sm font-medium text-text-secondary">Short Description</label>
            <textarea name="short_description" id="short_description" rows="2" required
                class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red @error('short_description') border-red-500 @enderror">{{ old('short_description', $product->short_description) }}</textarea>
            @error('short_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        
        <div>
            <label for="image" class="block text-sm font-medium text-text-secondary">Product Image</label>
            
            @if ($product->main_image)
            <div class="mt-2 mb-3">
                <p class="text-xs text-text-secondary mb-1">Current Image:</p>
                <img src="{{ asset('storage/' . $product->main_image) }}" alt="Current Product Image" class="w-20 h-20 object-cover rounded-md border border-main-border">
            </div>
            @endif

            <input type="file" name="image" id="image" 
                class="mt-1 block w-full text-sm text-text-primary border border-main-border rounded-md p-1.5 cursor-pointer focus:outline-none @error('image') border-red-500 @enderror">
            <p class="text-xs text-text-secondary mt-1">Leave blank to keep the current image.</p>
            @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="stock" class="block text-sm font-medium text-text-secondary">Stock Quantity</label>
            <input type="number" name="stock" id="stock" required
                class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red @error('stock') border-red-500 @enderror"
                value="{{ old('stock', $product->stock) }}">
            @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="regular_price" class="block text-sm font-medium text-text-secondary">Regular Price ($)</label>
                <input type="number" step="0.01" name="regular_price" id="regular_price" required
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red @error('regular_price') border-red-500 @enderror"
                    value="{{ old('regular_price', $product->regular_price) }}">
                @error('regular_price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="sell_price" class="block text-sm font-medium text-text-secondary">Selling Price (Optional)</label>
                <input type="number" step="0.01" name="sell_price" id="sell_price"
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red @error('sell_price') border-red-500 @enderror"
                    value="{{ old('sell_price', $product->sell_price) }}">
                @error('sell_price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-green hover:bg-green-700 transition duration-300">
                Update Product
            </button>
        </div>
    </form>
</div>
@endsection