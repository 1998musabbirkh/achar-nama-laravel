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
        
        {{-- DISPLAY CURRENT IMAGES WITH DELETE OPTION --}}
        <div class="space-y-4">
            <label class="block text-sm font-medium text-text-secondary">Current Images (Check to Delete)</label>
            
            @if ($product->images->isEmpty())
                <p class="text-xs text-text-secondary">No images currently uploaded for this product.</p>
            @else
                <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-4">
                    @foreach ($product->images as $image)
                        <div class="relative group border border-main-border p-1 rounded-md">
                            {{-- Image Preview --}}
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image" 
                                class="w-full h-20 object-cover rounded-sm">
                            
                            {{-- Delete Checkbox Overlay --}}
                            <label class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer rounded-sm">
                                <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="form-checkbox h-5 w-5 text-brand-red bg-bg border-main-border focus:ring-brand-red">
                                <span class="ml-2 text-white text-xs font-semibold">Delete</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                <p class="text-xs text-text-secondary mt-2">Check the box on an image and click 'Update Product' to permanently remove it.</p>
            @endif
        </div>

        {{-- NEW MULTI-IMAGE UPLOAD INPUT --}}
        <div>
            <label for="images" class="block text-sm font-medium text-text-secondary">Add New Product Images (Max 5 total)</label>
            <input type="file" name="images[]" id="images" multiple
                class="mt-1 block w-full text-sm text-text-primary border border-main-border rounded-md p-1.5 cursor-pointer focus:outline-none @error('images') border-red-500 @enderror @error('images.*') border-red-500 @enderror">
            <p class="text-xs text-text-secondary mt-1">Select one or more new images to add to the gallery.</p>
            @error('images') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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